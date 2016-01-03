<?php
/**
 * Created by PhpStorm.
 * User: salseeg
 * Date: 03.01.16
 * Time: 20:20
 */

namespace AppBundle\Domain\Entity;


class Week
{
    private $number;

    protected $tags;

    /**
     * Week constructor.
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
        $this->tags = [];
    }

    function __get($name)
    {
        return isset($this->tags[$name])
            ? $this->tags[$name]
            : false
        ;
    }

    function __set($name, $value)
    {
        $this->tags[$name] = $value;
    }


}