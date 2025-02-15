<?php

namespace QueryBuilder\Expression\Criteria\TPropertie;

final class TPropertie
{
    public array $properties;

    public function __construct(){
        $this->properties = [];
    }

    public function setProperty($property, $value)
    {
        if(isset($value)){
            $this->properties[$property] = $value;
        } else {
            $this->properties[$property] = NULL;
        }
    }

    public function getProperty($property)
    {
        return $this->properties[$property] ?? NULL;   
    }
}