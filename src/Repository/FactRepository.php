<?php

namespace App\Repository;

use Psr\Http\Client\ClientInterface;
use App\Model\Fact;
use App\Model\FactCollection;
use App\Exception\HttpResponseException;
use App\Exception\InvalidResponseBodyException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use JsonException;
use stdClass;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use \App\Model\Status;
use \App\Model\User;
use App\Exception\InvalidFactTypeException;

class FactRepository 

{
    protected string $baseUrl;
    
    protected ClientInterface $httpClient;
    
    public function __construct(string $baseUrl, ClientInterface $httpClient) 
    {
        $this->baseUrl = $baseUrl;
        $this->httpClient = $httpClient;
    }
    
    public function getFact(string $id):Fact 
    {
        $request = $this->createRequest(
                $this->baseUrl.'/facts/'.$id);
        $response = $this->httpClient->sendRequest($request);
        try{
            $this->ensureHttpResponseIsOK($response);
        } catch (HttpResponseException $ex) {
            $ex->getMessage();
        }
        $body = $response->getBody();
        try{
          
            $decodedBody = $this->decodeResponceBody($body);
            $fact = $this->createFact($decodedBody);
        } catch(InvalidResponseBodyException $ex){
            $ex->getMessage();
        }
           
        return $fact;
    }
    
    public function getRandomList(
            int $amount = 10,
            string $animalType = Fact::CAT
            ): FactCollection {
        
        $factCollection = new FactCollection();
            $request = $this->createRequest(
                    $this->baseUrl.'/facts/random?animal_type='.$animalType.'&amount='.$amount);
               $response = $this->httpClient->sendRequest($request);
               
               $userRequest = $this->createRequest(
                    $this->baseUrl.'/users/');
               $response = $this->httpClient->sendRequest($request);
            try{
                $this->ensureHttpResponseIsOK($response);
            } catch (HttpResponseException $ex) {
                $ex->getMessage();
            }
            $body = $response->getBody();
            try {
                $decodedBody = $this->decodeResponceBody($body);
                for($i=0; $i<DEFAULT_AMOUNT; $i++){
                    $bodyToObj = (object)array_values($decodedBody)[$i];
                    $factObj = $this->createFact($bodyToObj);
                    $factCollection->offsetSet($i, $factObj);
                    
                }
            } catch(InvalidResponseBodyException $ex){
                $ex->getMessage();
            }           
        return $factCollection;
    }
    
    protected function createFact(\stdClass $object): Fact 
    {
        $fact = new Fact();
        if(isset($object->{'status'}->{'verified'})){
            $verified = $object->{'status'}->{'verified'};
        } else {
            $verified = false;
        }
        if(isset($object->{'status'}->{'sentCount'})){
            $sentCount = $object->{'status'}->{'sentCount'};
        } else {
            $sentCount = 0;
        }
        $status = new Status(
                $verified, $sentCount);
        $fact->setStatus($status);
  
        $fact->setId($object->{'_id'});
        $fact->setText($object->{'text'});
        try{
            $fact->setType($object->{'type'});
        } catch(InvalidFactTypeException $ex){
            $ex->getMessage();
        }
        
        $dateCreatedAt = date_create_immutable(
                $object->{'createdAt'});
        $fact->setCreatedAt($dateCreatedAt);
        
        if($object->{'updatedAt'}== ''){
            $fact->setUpdatedAt($dateCreatedAt);
        }
        $dateUpdatedAt = date_create_immutable(
                $object->{'updatedAt'});
        $fact->setUpdatedAt($dateUpdatedAt); 
        return $fact;
    } 
    
    protected function createRequest(
            string $endpoint, 
            array $params = []
            ): RequestInterface {
        $this->httpClient = new Client();
        $request = new Request('GET', $endpoint,$params); 
        return $request;
    }
  
    protected function decodeResponceBody(
            StreamInterface $body
            ):array|\stdClass {
        try{
            $decodedBody = json_decode($body, null, );
        } catch(JsonException $ex){
            $ex->getMessage();
            throw new InvalidResponseBodyException('Problem with json decoding'
                    . 'of the response body ');
        }
        return $decodedBody;
    }
    
    protected function ensureHttpResponseIsOK(ResponseInterface $response) 
    {
        if($response->getStatusCode() != 200){
            throw new HttpResponseException('Http response code != 200 / NOT OK.');
        }
    }
  
}


