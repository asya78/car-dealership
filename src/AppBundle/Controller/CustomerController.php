<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *Customer controller.
 *
 *@Route("customer")
 */
class CustomerController extends Controller
{
    /**
     *Lists all customer entities.
     *
     *@Route("/", name="customer_index")
     *@Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('AppBundle:Customer')->findAll();

        return $this->render('customer/index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     *Finds and displays a customer entity.
     *
     *@Route("/{id}", name="customer_show")
     *@Method("GET")
     */
    public function showAction(Customer $customer)
    {

        return $this->render('customer/show.html.twig', array(
            'customer' => $customer,
        ));
    }

    /**
     *Get all customers ordered by their sort
     *@Route("/all/{sort}", name="customer_sort")
     */
    public function sortAction($sort)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository('AppBundle:Customer')
            ->getAllCustomers($sort);

        return $this->render('customer/show.html.twig',array('customer'=>$customer));

    }


}
