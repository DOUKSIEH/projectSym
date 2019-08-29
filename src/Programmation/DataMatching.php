<?php

namespace App\Programmation;


class DataMatching {

    private $dm;


    public function __construct(\DateTime $dm)
    {

        $this->dm = $dm;

    }

    public function  isDateInterval($d1,$d2,$d3)
    {

    }

    public function isPast(\DateTime $d) : bool
    {

        if ($this->dm > $d)
        {

            return true;
        } 

        return false;
    }
    
    public function isOverlap(){

    }
}