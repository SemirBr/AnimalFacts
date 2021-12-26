<?php

namespace App\Repository;

use Repository\FactRepository;


class FactRepositoryFactory 
{
    public static function create(): FactRepository 
    {
        return FactRepository(\BASE_URL, new Client());
    }
}