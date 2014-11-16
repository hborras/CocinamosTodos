<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UtilsController extends Controller
{
    public function sluggerAction($string)
    {
        $slug = $this->get('slugger')->slugify($string);

        return new Response($slug);
    }
}
