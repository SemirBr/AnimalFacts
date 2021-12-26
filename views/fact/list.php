<div class="accordion" id="factList">
<?php

foreach ($list as $fact) {
    echo $this->render('partials/fact_item', ['fact' => $fact]);
}

?>
</div>