<?php

namespace App\Hello;

class Geo {

   public $geo;
   public $search;

   public function __construct(string $s, string $l)
   {
       $this->geo = $s;
       $this->search = $l ;
   }
    public function geolocalise(string $s)
    {
        $url = str_replace(" ","+",$s);
        // initialisation de la session
        $ch = curl_init();

        // configuration des options
        curl_setopt($ch, CURLOPT_URL, $this->geo . $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        // exécution de la session
        $r = curl_exec($ch);

        // fermeture des ressources
        curl_close($ch);

        return $r;
    }
    public function searchArtist(string $s)
    {
       
        // initialisation de la session
        $ch = curl_init();

        // configuration des options
        curl_setopt($ch, CURLOPT_URL, $this->search . $s  . "&format=json");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        // exécution de la session
        $r = curl_exec($ch);

        // fermeture des ressources
        curl_close($ch);

        return $r;
    }
}