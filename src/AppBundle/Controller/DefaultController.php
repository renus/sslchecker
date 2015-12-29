<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @package AppBundle\Controller
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template("default/index.html.twig")
     */
    public function indexAction()
    {
       return [];
    }

    /**
     * @param $status text
     * @param $message text
     */
    private function jsonResponse($status, $message, Array $response = [])
    {
        return new JsonResponse([
            'status'   => $status,
            'message'  => $message,
            'response' => $response
        ]);
    }
}
