<?php

namespace App\Hello;

class HelloWorld {

    private $prenom;
    private $case;

    public function __construct(string $p, MessageUpper $u)
    {
      $this->prenom = $p ;
      $this->case = $u;
    }

    public function yo()
    {
        return "ca marche $this->prenom";
    }
    public function yoUpper()
    {
        return $this->case->upper($this->yo());
    }
}

