<?php
/**
 * Created by PhpStorm.
 * User: salseeg
 * Date: 03.01.16
 * Time: 20:28
 */

namespace Tests\AppBundle\Domain\Entity;


use AppBundle\Domain\Entity\Week;

class WeekTest extends \PHPUnit_Framework_TestCase
{
    function testCreation(){
        $w = new Week(32);
        $w->x_test = true;

        $this->assertAttributeEquals(32, 'number', $w);
        $this->assertTrue($w->x_test);
        $this->assertFalse($w->else);

    }
}
