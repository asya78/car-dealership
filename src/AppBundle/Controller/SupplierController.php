<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Supplier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Supplier controller.
 *
 */
class SupplierController extends Controller
{
    /**
     * Lists all supplier entities.
     *
     * @Route("/supplier", name="supplier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $suppliers = $em->getRepository('AppBundle:Supplier')->findAll();

        return $this->render('supplier/index.html.twig', array(
            'suppliers' => $suppliers,
        ));
    }

    /**
     * Creates a new supplier entity.
     *
     * @Route("/supplier/new", name="supplier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $supplier = new Supplier();
        $form = $this->createForm('AppBundle\Form\SupplierType', $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplier);
            $em->flush();

            return $this->redirectToRoute('supplier_show', array('id' => $supplier->getId()));
        }

        return $this->render('supplier/new.html.twig', array(
            'supplier' => $supplier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a supplier entity.
     *
     * @Route("/supplier/{id}", name="supplier_show")
     * @Method("GET")
     */
    public function showAction(Supplier $supplier)
    {
        $deleteForm = $this->createDeleteForm($supplier);

        return $this->render('supplier/show.html.twig', array(
            'supplier' => $supplier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing supplier entity.
     *
     * @Route("/supplier/{id}/edit", name="supplier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Supplier $supplier)
    {
        $deleteForm = $this->createDeleteForm($supplier);
        $editForm = $this->createForm('AppBundle\Form\SupplierType', $supplier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('supplier_edit', array('id' => $supplier->getId()));
        }

        return $this->render('supplier/edit.html.twig', array(
            'supplier' => $supplier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a supplier entity.
     *
     * @Route("/supplier/{id}", name="supplier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Supplier $supplier)
    {
        $form = $this->createDeleteForm($supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supplier);
            $em->flush();
        }

        return $this->redirectToRoute('supplier_index');
    }

    /**
     * Creates a form to delete a supplier entity.
     *
     * @param Supplier $supplier The supplier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Supplier $supplier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supplier_delete', array('id' => $supplier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/suppliers/{isImporter}")
     */
    public function localSupplier($isImporter)
    {

        $suppliers = $this
            ->getDoctrine()
            ->getRepository(Supplier::class)
            ->getSupplierByImporter($isImporter);

        return $this->render('supplier/local.html.twig',array('suppliers'=>$suppliers));
    }

}
