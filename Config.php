<?php

//Config class has a non-static method get() 
class Config{
    private $data;

    public function __construct(DataProvider $dataProvider) {
        $this->data = $dataProvider->fetchData();
    }

    public function get(): string{
        return $this->data;
    }
}