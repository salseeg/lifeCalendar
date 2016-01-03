<?php
/**
 * Created by PhpStorm.
 * User: salseeg
 * Date: 03.01.16
 * Time: 17:10
 */

namespace Tests\AppBundle\Domain\Entity;


use AppBundle\Domain\Entity\Year;

class YearTest extends \PHPUnit_Framework_TestCase
{
    function testConstruction(){
        $y = new Year(2016);

        $this->assertAttributeEquals(2016, 'year', $y);
        $this->assertAttributeEquals(3, 'firstWeekOffset', $y);

        $this->assertEquals(3, $y->getFirstWeekOffset());

    }

    function testOffsets(){
        $provenOffsets = [
            2080 => 0,
            2045 => 1,
            2081 => -2,
        ];

        foreach ($provenOffsets as $year => $offset){
            $y = new Year($year);
            $this->assertEquals($offset, $y->getFirstWeekOffset());
        }
    }

    function testWeeks(){
        $provenWeeks = [
            2016 => [
                1 => -1,
                32 => 5,
                60 => 9,
            ],
            2013 => [
                35 => 6,
                34 => 5,
            ],
            2011 => [
                30 => 4,
                31 => 5
            ],
        ];

        foreach ($provenWeeks  as $year => $weeks){
            $y = new Year($year);
            foreach ($weeks as $day => $week){
                $this->assertEquals($week, $y->getWeekOfDay($day));
            }
        }
    }

}
