<?php

namespace Cinhetic\PublicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cinhetic\PublicBundle\Entity\Directors;
use Cinhetic\PublicBundle\Form\DirectorsType;

/**
 * Directors controller.
 *
 */
class DirectorsController extends Controller
{

    /**
     * Lists all Directors entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CinheticPublicBundle:Directors')->findAll();

        return $this->render('CinheticPublicBundle:Directors:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Directors entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Directors();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('directors_show', array('id' => $entity->getId())));
        }

        return $this->render('CinheticPublicBundle:Directors:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Directors entity.
    *
    * @param Directors $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Directors $entity)
    {
        $form = $this->createForm(new DirectorsType(), $entity, array(
            'action' => $this->generateUrl('directors_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer ce réalisateur'));

        return $form;
    }

    /**
     * Displays a form to create a new Directors entity.
     *
     */
    public function newAction()
    {
        $entity = new Directors();
        $form   = $this->createCreateForm($entity);

        return $this->render('CinheticPublicBundle:Directors:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Directors entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CinheticPublicBundle:Directors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directors entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $entity->getMovies(),
            $this->get('request')->query->get('pageone', 1) /*page number*/,
            5,
            array('pageParameterName' => 'pageone')
        );

        return $this->render('CinheticPublicBundle:Directors:show.html.twig', array(
            'entity'      => $entity,
            'movies'      => $pagination,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Directors entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CinheticPublicBundle:Directors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directors entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CinheticPublicBundle:Directors:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Directors entity.
    *
    * @param Directors $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Directors $entity)
    {
        $form = $this->createForm(new DirectorsType(), $entity, array(
            'action' => $this->generateUrl('directors_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }


    /**
     * Edits an existing Directors entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CinheticPublicBundle:Directors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directors entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('directors_edit', array('id' => $id)));
        }

        return $this->render('CinheticPublicBundle:Directors:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a Directors entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CinheticPublicBundle:Directors')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Directors entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('directors'));
    }

    /**
     * Creates a form to delete a Directors entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('directors_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
