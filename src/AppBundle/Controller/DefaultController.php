<?php

namespace AppBundle\Controller;

use AppBundle\Domain\Entity\Calendar;
use AppBundle\Domain\Entity\CalendarConfigForm;
use AppBundle\Domain\Entity\Year;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    /**
     * @param string $date
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/calendar/{date}" , name="calendar", requirements={
     *          "date" : "\d{4}-\d{2}-\d{2}"
     *     })
     */
    public function showCalendarAction($date){
        $birthDate = new \DateTime($date);

        $calendar = new Calendar($birthDate);

        return $this->render('default/calendar.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    /**
     * @param Request $request
     *
     * @Route("/form", name="calendarForm")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showBirthDateFormAction(Request $request){
        $formData = new CalendarConfigForm();

        $form = $this->createFormBuilder($formData)
            ->add('birthDate', DateType::class)
            ->add('send', SubmitType::class, ['label' => 'Get Calendar'])
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() and $form->isValid()){
//            var_dump($form); die;
            $date = $form->get('birthDate');
            var_dump($date); die();

        }

        return $this->render('default/calendar.form.html.twig',[
                'form' => $form->createView(),
            ]
        );


    }
}
