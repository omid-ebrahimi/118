<?php

namespace S118\EbrahimiBundle\Controller;

use S118\EbrahimiBundle\Form\PersonEntitySearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use S118\EbrahimiBundle\Entity\PersonEntity;
use S118\EbrahimiBundle\Form\PersonEntityType;

/**
 * PersonEntity controller.
 *
 */
class PersonEntityController extends Controller
{
    /**
     * Lists all PersonEntity entities.
     *
     */
    public function indexAction()
    {
        $form = $this->createForm(new PersonEntitySearchType());

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb = $qb->select('person')
            ->from('S118EbrahimiBundle:PersonEntity', 'person');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb->getQuery(),
            $this->get('request')->query->get('page', 1) /*page number*/,
            3/*limit per page*/
        );

        return $this->render('S118EbrahimiBundle:PersonEntity:index.html.twig', array(
            'entities' => $pagination,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new PersonEntity entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new PersonEntity();
        $form = $this->createForm(new PersonEntityType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            $entity->upload($entity->getId());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', array('id' => $entity->getId())));
        }

        return $this->render('S118EbrahimiBundle:PersonEntity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new PersonEntity entity.
     *
     */
    public function newAction()
    {
        $entity = new PersonEntity();
        $form   = $this->createForm(new PersonEntityType(), $entity);

        return $this->render('S118EbrahimiBundle:PersonEntity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PersonEntity entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('S118EbrahimiBundle:PersonEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonEntity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('S118EbrahimiBundle:PersonEntity:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing PersonEntity entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('S118EbrahimiBundle:PersonEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonEntity entity.');
        }

        $editForm = $this->createForm(new PersonEntityType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('S118EbrahimiBundle:PersonEntity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PersonEntity entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('S118EbrahimiBundle:PersonEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonEntity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PersonEntityType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('person_edit', array('id' => $id)));
        }

        return $this->render('S118EbrahimiBundle:PersonEntity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PersonEntity entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('S118EbrahimiBundle:PersonEntity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PersonEntity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('person'));
    }

    /**
     * Creates a form to delete a PersonEntity entity by id.
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

    public function searchAction(Request $request)
    {
        $form = $this->createForm(new PersonEntitySearchType());
        $form->bind($request);

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        if($form["phtype"]->getData()!=null || $form["status"]->getData()!=null || $form["number"]->getData()!='')
        {
        $qb = $qb->select('person')
            ->from('S118EbrahimiBundle:PersonEntity', 'person')
            ->join('person.PhoneEntities', 'phone');
            if($form["phtype"]->getData()!=null)
                $qb->andWhere($qb->expr()->eq('phone.type', $form["phtype"]->getData()));
            if($form["status"]->getData()!=null)
                $qb->andWhere($qb->expr()->eq('phone.status', $form["status"]->getData()));
            if($form["number"]->getData()!=null)
                $qb->andWhere($qb->expr()->eq('phone.number', $form["number"]->getData()));
        }
        else
        {
            $qb = $qb->select('person')
                ->from('S118EbrahimiBundle:PersonEntity', 'person');
        }

        if($form["fn"]->getData()!=null)
            $qb->andWhere($qb->expr()->like('person.fn', $qb->expr()->literal($form["fn"]->getData() . '%')));
        if($form["ln"]->getData()!=null)
            $qb->andWhere($qb->expr()->like('person.ln', $qb->expr()->literal($form["ln"]->getData() . '%')));
        if($form["city"]->getData()!=null)
            $qb->andWhere($qb->expr()->like('person.city', $qb->expr()->literal($form["city"]->getData() . '%')));
        if($form["street"]->getData()!=null)
            $qb->andWhere($qb->expr()->like('person.street', $qb->expr()->literal($form["street"]->getData() . '%')));
        if($form["alley"]->getData()!=null)
            $qb->andWhere($qb->expr()->like('person.alley', $qb->expr()->literal($form["alley"]->getData() . '%')));
        if($form["ptype"]->getData()!=null)
            $qb->andWhere($qb->expr()->eq('person.type', $form["ptype"]->getData()));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb->getQuery(),
            $this->get('request')->query->get('page', 1) /*page number*/,
            3/*limit per page*/
        );
        return $this->render('S118EbrahimiBundle:PersonEntity:index.html.twig', array(
            'entities' => $pagination,
            'form' => $form->createView(),
        ));
    }
}
