<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HtmlExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('figure', [$this, 'figureFilter']),
        ];
    }

    public function figureFilter($image, $filter)
    {
       
        $rendu = "<figure><img src = '$image'  alt = loll </img><br><caption>";

        $rendu .= $filter ."</caption><figure>" ;

        return $rendu;
    }
}