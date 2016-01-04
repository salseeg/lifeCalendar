<?php

namespace AppBundle\Controller;

use AppBundle\Domain\Entity\Calendar;
use AppBundle\Domain\Entity\Year;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    public function getYearOffsets(array $years){
        $offsets = [];

        foreach($years as $y){


            $offsets[$y] = (new Year($y)).'';
        }

        return $offsets;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/offset", name="offset")
     */
    public function offsetAction(Request $request){
//        $offsets = $this->getYearOffsets(range(1983, 2016));
        $calendar = new Calendar(1983, 2073);
        return $this->render('default/calendar.html.twig', [
            'calendar' => $calendar,
        ]);
    }
}
