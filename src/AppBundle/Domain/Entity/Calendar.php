<?php
/**
 * Created by PhpStorm.
 * User: salseeg
 * Date: 04.01.16
 * Time: 21:27
 */

namespace AppBundle\Domain\Entity;

use AppBundle\Domain\Entity\Year;

class Calendar
{

    /** @var  int */
    protected $firstYear;

    /** @var  int */
    protected $lastYear;

    /** @var  Year[] */
    public $years;

    /**
     * Calendar constructor.
     * @param int $firstYear
     * @param int $lastYear
     */
    public function __construct($firstYear, $lastYear)
    {
        $this->firstYear = $firstYear;
        $this->lastYear = max($lastYear, $firstYear);

        $this->fillYears();
    }

    private function fillYears(){
        foreach (range($this->firstYear, $this->lastYear ) as $year){
            $this->years[$year] = new Year($year);
        }
    }




}