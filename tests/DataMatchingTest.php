<?php

use PHPUnit\Framework\TestCase;
use App\Programmation\DataMatching;


class DataMatchingTest extends TestCase {

    
    protected $dm;

        public function testVoid()
        {
            $this->assertEquals(0,0);

        }

        public function setUp() : void
        {
            
            $this->dm = new DataMatching(new \DateTime('1983/09/18'));
        }

        public function testDown()
        {
            $this->dm = null;
        }

        public function dateProvider()
        {
            return [
                [ new \DateTime('1983/09/17') , true ],
                [ new \DateTime(), false]
            ];
        }

        /**
         * 
         * @dataProvider dateProvider
         * @param [type] $d
         * @param [type] $t
         * @return void
         */
        public function testIsPast(\DateTime $d , bool $t)
        {
            
            $this->assertEquals($t,$this->dm->isPast($d), "Date : ".date_format($d, 'd/m/Y'));

        }

}