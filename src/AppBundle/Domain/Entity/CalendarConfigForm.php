<?php
/**
 * Created by PhpStorm.
 * User: salseeg
 * Date: 07.01.16
 * Time: 11:25
 */

namespace AppBundle\Domain\Entity;




class CalendarConfigForm
{
    /** @var  \DateTime */
    public $birthDate;

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }


}