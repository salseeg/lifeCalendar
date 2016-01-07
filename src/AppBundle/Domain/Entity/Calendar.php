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

    /** @var  \DateTime */
    protected $birthDate;

    /** @var  Year[] */
    public $years;

    public function __construct(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;

        $currentYear = (int) date("Y");

        $this->firstYear = (int) $birthDate->format("Y");
        $this->lastYear = max($currentYear + 20, $this->firstYear + 90);

        $this->fillYears();
    }

    private function fillYears(){
        foreach (range($this->firstYear, $this->lastYear ) as $year){
            $this->years[$year] = new Year($year);
        }
    }




}