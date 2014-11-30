<?php

namespace AppBundle\Controller\BackendController;

use AppBundle\Form\DifficultyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Difficulty;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DifficultyController extends Controller
{
    /**
     * Get all difficulties
     *
     * @param string $format
     *
     * @return Response
     */
    public function indexAction($format)
    {
        $em = $this->getDoctrine()->getManager();
        $difficulties = $em->getRepository('AppBundle:Difficulty')->findAllDifficulty();
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($difficulties, $format));
        }
        return $this->render('AppBundle:Backend/Difficulty:index.html.twig', array(
            'difficulties' => $difficulties
        ));
    }

    /**
     * Show a difficulty and its recipes
     *
     * @param Difficulty $difficulty
     * @param string $format
     *
     * @return Response
     *
     * @ParamConverter("difficulty", class="AppBundle:Difficulty")
     */
    public function showAction(Difficulty $difficulty, $format)
    {
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($difficulty, $format));
        }
        return $this->render('AppBundle:Backend/Difficulty:show.html.twig', array(
            'entity' => $difficulty
        ));
    }

    /**
     * Displays a form to create a new Difficulty entity.
     *
     * @return Response
     *
     */
    public function newAction()
    {
        $difficulty = new Difficulty();
        $form   = $this->createForm(new DifficultyType(), $difficulty, array(
            'action' => $this->generateUrl('backend_difficulty_create')
        ));

        return $this->render('AppBundle:Backend\Difficulty:new.html.twig', array(
            'entity' => $difficulty,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Difficulty entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $difficulty  = new Difficulty();
        $form    = $this->createForm(new DifficultyType(), $difficulty);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($difficulty);
            $em->flush();

            return $this->render('AppBundle:Backend/Difficulty:show.html.twig', array(
                'entity' => $difficulty
            ));
        }

        return $this->render('AppBundle:Backend/Difficulty:new.html.twig', array(
            'entity' => $difficulty,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to modify a Difficulty entity.
     *
     * @param Difficulty $difficulty
     *
     * @return Response
     *
     * @ParamConverter("difficulty", class="AppBundle:Difficulty")
     */
    public function editAction(Difficulty $difficulty)
    {
        if (!$difficulty) {
            throw $this->createNotFoundException("Error, We haven't founded this difficulty");
        }

        $form = $this->createForm(new DifficultyType(), $difficulty,
            array(
                'action' => $this->generateUrl('backend_difficulty_update',
                                            array(
                                                    'id' => $difficulty->getId()
                                                )
                                            )
        ));

        return $this->render('AppBundle:Backend/Difficulty:edit.html.twig', array(
            'entity'      => $difficulty,
            'form'   => $form->createView()
        ));
    }

    /**
     * Modifies a Difficulty
     *
     * @param Difficulty $difficulty
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("difficulty", class="AppBundle:Difficulty")
     */
    public function updateAction(Difficulty $difficulty,Request $request)
    {
        if (!$difficulty) {
            throw $this->createNotFoundException("Error, We haven't founded this difficulty");
        }
        $form   = $this->createForm(new DifficultyType(), $difficulty);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($difficulty);
            $em->flush();

            return $this->render('AppBundle:Backend/Difficulty:show.html.twig', array(
                'entity' => $difficulty
            ));
        }

        return $this->render('AppBundle:Backend/Difficulty:edit.html.twig', array(
            'entity'      => $difficulty,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Removes a Difficulty
     *
     * @param Difficulty $difficulty
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("difficulty", class="AppBundle:Difficulty")
     */
    public function deleteAction(Difficulty $difficulty, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$difficulty) {
            throw $this->createNotFoundException('No se ha encontrado la categoria solicitada');
        }

        $em->remove($difficulty);
        $em->flush();
        if ($request->isXmlHttpRequest()) {
            $return = json_encode(array("result" => "OK"));

            return new Response($return,200, array('Content-Type' => 'application/json'));
        } else {
            return $this->redirect($this->generateUrl('backend_difficulty_index'));
        }
    }
}
