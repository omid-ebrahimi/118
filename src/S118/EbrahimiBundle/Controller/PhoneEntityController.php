<?php

namespace S118\EbrahimiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use S118\EbrahimiBundle\Entity\PhoneEntity;
use S118\EbrahimiBundle\Form\PhoneEntityType;

/**
 * PhoneEntity controller.
 *
 */
class PhoneEntityController extends Controller
{
    /**
     * Lists all PhoneEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('S118EbrahimiBundle:PhoneEntity')->findAll();

        return $this->render('S118EbrahimiBundle:PhoneEntity:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new PhoneEntity entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new PhoneEntity();
        $form = $this->createForm(new PhoneEntityType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('phone_show', array('id' => $entity->getId())));
        }

        return $this->render('S118EbrahimiBundle:PhoneEntity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new PhoneEntity entity.
     *
     */
    public function newAction()
    {
        $entity = new PhoneEntity();
        $form   = $this->createForm(new PhoneEntityType(), $entity);

        return $this->render('S118EbrahimiBundle:PhoneEntity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PhoneEntity entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('S118EbrahimiBundle:PhoneEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PhoneEntity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('S118EbrahimiBundle:PhoneEntity:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing PhoneEntity entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('S118EbrahimiBundle:PhoneEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PhoneEntity entity.');
        }

        $editForm = $this->createForm(new PhoneEntityType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('S118EbrahimiBundle:PhoneEntity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PhoneEntity entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('S118EbrahimiBundle:PhoneEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PhoneEntity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PhoneEntityType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('phone_edit', array('id' => $id)));
        }

        return $this->render('S118EbrahimiBundle:PhoneEntity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PhoneEntity entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('S118EbrahimiBundle:PhoneEntity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PhoneEntity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('phone'));
    }

    /**
     * Creates a form to delete a PhoneEntity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
