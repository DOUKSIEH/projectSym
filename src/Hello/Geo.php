<?php

namespace App\Hello;

class Geo {

   private $geo;

   public function __construct(string $s)
   {
       $this->geo = $s;
   }
    public function geolocalise(string $s)
    {
        $url = str_replace(" ","+",$s);
        // initialisation de la session
        $ch = curl_init();

        // configuration des options
        curl_setopt($ch, CURLOPT_URL, $this->geo . $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        // exécution de la session
        $r = curl_exec($ch);

        // fermeture des ressources
        curl_close($ch);

        return $r;
    }
}