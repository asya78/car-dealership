<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Car controller.
 *
 */
class CarController extends Controller
{
    /**
     * Lists all car entities.
     *
     * @Route("/car", name="car_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('AppBundle:Car')->findAll();

        return $this->render('car/index.html.twig', array(
            'cars' => $cars,
        ));
    }

    /**
     * Finds and displays a car entity.
     *
     * @Route("/car/{id}", name="car_show")
     * @Method("GET")
     */
    public function showAction($car)
    {

        return $this->render('car/show.html.twig', array(
            'car' => $car,
        ));
    }

    /**
     * @Route("/cars/{make}")
     * @Method("GET")
     * @param $make
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makeAction($make)
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('AppBundle:Car')->getAllCarBy($make);

        return $this->render('car/make.html.twig', array('cars' => $cars));
    }
}
