<?php

namespace AppBundle\Controller\BackendController;

use AppBundle\Form\NationalityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Nationality;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\NationalityManagerInterface;

class NationalityController extends Controller
{
    /**
     * Get all nationalities
     *
     * @param string $format
     *
     * @return Response
     */
    public function indexAction($format)
    {
        $nationalities = $this->getNationalityManager()->findNationalities();
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($nationalities, $format));
        }
        return $this->render('AppBundle:Backend/Nationality:index.html.twig', array(
            'nationalities' => $nationalities
        ));
    }

    /**
     * Show a nationality and its recipes
     *
     * @param Nationality $nationality
     * @param string $format
     *
     * @return Response
     *
     * @ParamConverter("nationality", class="AppBundle:Nationality")
     */
    public function showAction(Nationality $nationality, $format)
    {
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($nationality, $format));
        }
        return $this->render('AppBundle:Backend/Nationality:show.html.twig', array(
            'entity' => $nationality
        ));
    }

    /**
     * Displays a form to create a new Nationality entity.
     *
     * @return Response
     *
     */
    public function newAction()
    {
        $nationality = $this->getNationalityManager()->createNationality();
        $form   = $this->createForm(new NationalityType(), $nationality, array(
            'action' => $this->generateUrl('backend_nationality_create')
        ));

        return $this->render('AppBundle:Backend\Nationality:new.html.twig', array(
            'entity' => $nationality,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Nationality entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $nationality  = $this->getNationalityManager()->createNationality();
        $form    = $this->createForm(new NationalityType(), $nationality);

        $form->handleRequest($request);
        if ($form->isValid()) {

            $this->getNationalityManager()->uploadPicture($nationality);
            $this->getNationalityManager()->saveNationality($nationality);

            return $this->render('AppBundle:Backend/Nationality:show.html.twig', array(
                'entity' => $nationality
            ));
        }

        return $this->render('AppBundle:Backend/Nationality:new.html.twig', array(
            'entity' => $nationality,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to modify a Nationality entity.
     *
     * @param Nationality $nationality
     *
     * @return Response
     *
     * @ParamConverter("nationality", class="AppBundle:Nationality")
     */
    public function editAction(Nationality $nationality)
    {
        $form = $this->createForm(new NationalityType(), $nationality,
            array(
                'action' => $this->generateUrl('backend_nationality_update',
                                            array(
                                                    'id' => $nationality->getId()
                                                )
                                            )
        ));

        return $this->render('AppBundle:Backend/Nationality:edit.html.twig', array(
            'entity'      => $nationality,
            'form'   => $form->createView()
        ));
    }

    /**
     * Modifies a Nationality
     *
     * @param Nationality $nationality
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("nationality", class="AppBundle:Nationality")
     */
    public function updateAction(Nationality $nationality,Request $request)
    {
        $form   = $this->createForm(new NationalityType(), $nationality);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->getNationalityManager()->uploadPicture($nationality);
            $this->getNationalityManager()->saveNationality($nationality);
            return $this->render('AppBundle:Backend/Nationality:show.html.twig', array(
                'entity' => $nationality
            ));
        }

        return $this->render('AppBundle:Backend/Nationality:edit.html.twig', array(
            'entity'      => $nationality,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Removes a Nationality
     *
     * @param Nationality $nationality
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("nationality", class="AppBundle:Nationality")
     */
    public function deleteAction(Nationality $nationality, Request $request)
    {
        $this->getNationalityManager()->deleteNationality($nationality);

        if ($request->isXmlHttpRequest()) {
            $return = json_encode(array("result" => "OK"));

            return new Response($return,200, array('Content-Type' => 'application/json'));
        } else {
            return $this->redirect($this->generateUrl('backend_nationality_index'));
        }
    }

    /**
     * @return NationalityManagerInterface
     */
    protected function getNationalityManager()
    {
        return $this->container->get('app_bundle.manager.nationality');
    }
}
