<?php

namespace My\GuestBookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use My\GuestBookBundle\Entity\Post;
use My\GuestBookBundle\Form\PostType;


/**
 * Post controller.
 *
 */
class PostController extends Controller
{


    /**
     * Lists all Post entities.
     *
     */

    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GuestBookBundle:Post')->findAll();
        $adapter = new ArrayAdapter($entities);

       // $entities = $em->getRepository('GuestBookBundle:Post')->createQueryBuilder();
       // $adapter = new DoctrineORMAdapter($entities);


        $pagerfanta = new Pagerfanta($adapter);
        $maxPerPage = $this->container->getParameter('maxPerPage');
        $pagerfanta->setMaxPerPage($maxPerPage); // 10 by default
        $pagerfanta->setCurrentPage($page); // 1 by default
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity);
        return $this->render(
            'GuestBookBundle:Post:index.html.twig',
            array(
                'entities' => $pagerfanta->getCurrentPageResults(),
                'form' => $form->createView(),
                'my_pager' => $pagerfanta,
            )
        );
    }


    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GuestBookBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'GuestBookBundle:Post:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction()
    {
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity);

        return $this->render(
            'GuestBookBundle:Post:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        return $this->render(
            'GuestBookBundle:Post:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GuestBookBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createForm(new PostType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'GuestBookBundle:Post:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GuestBookBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return $this->render(
            'GuestBookBundle:Post:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GuestBookBundle:Post')->find($id);
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('guest_book_homepage'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
