<?php

class Paginator{

    public $limit;
    public $offset;
    public $records_per_page;

    public function __construct($page_number, $records_per_page){
        $this->records_per_page = $records_per_page;
        $page_number = filter_var($page_number, FILTER_VALIDATE_INT);
        if($page_number < 1 || is_null($page_number)){
            $page_number = 1;
        }
        $this->limit = $records_per_page;
        $this->offset = $records_per_page * ($page_number - 1);

    }
}