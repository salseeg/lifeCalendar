<?php
/**
 * Created by PhpStorm.
 * User: salseeg
 * Date: 03.01.16
 * Time: 12:26
 */
declare(strict_types=1);

namespace AppBundle\Domain\Entity;

//use \int;

class Year
{
    /**
     * @var int
     */
    private $year;

    /**
     * negative if week starts in prev year
     *
     * @var int
     */
    private $firstWeekOffset;

    /** @var Week[] */
    public $weeks = [];

    /**
     * Year constructor.
     * @param int $year
     */
    function __construct(int $year)
    {
        $this->year = $year;
        $this->firstWeekOffset = $this->calculateFirstWeekOffset($year);
        $this->fillWeeks();
    }

    protected function calculateFirstWeekOffset(int $year){
        $d = new \DateTime($year.'-01-01');
        $dow = $d->format("w");     // 0 = sun , 1-6 = mon-sat
        $dow += ($dow == 0) ? 7 : 0;    // 1-7 = mon-sun

        if ($dow > 4){ // first day of first week in this year
            return 8 - $dow;
        }else{
            return 1 - $dow ;
        }

    }

    /**
     * @return int
     */
    public function getFirstWeekOffset()
    {
        return $this->firstWeekOffset;
    }

    public function __toString()
    {
        return implode(',', array_keys($this->weeks));
    }

    /**
     * @param int $day
     * @return int
     */
    public function getWeekOfDay(int $day){
        $day -= $this->firstWeekOffset;
        if ($day <= 0){
            return -1;
        }
        $day -= 1;
        return floor($day / 7) + 1;
    }

    protected function fillWeeks(){
        $maxDay = date('z', strtotime($this->year.'-12-31')) + 1;
        $days = range(1, $maxDay, 7);
        $days += range(1, 10);
        $days += range($maxDay - 10, $maxDay);
        $days = array_unique($days);

        $weeks = array_map(function($d){
            return $this->getWeekOfDay($d);
        }, $days);

        unset($days);

        $weeks = array_filter($weeks, function($x){ return $x > 0; });

        sort($weeks);

        foreach ($weeks as $w) {
            $this->weeks[$w] = new Week($w);
        }

    }


}