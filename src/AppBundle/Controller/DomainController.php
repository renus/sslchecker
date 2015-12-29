<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DomainController
 *
 * @package AppBundle\Controller
 * @Route("/domain")
 */
class DomainController extends Controller
{
    /**
     * @Route("/create", name="domain_create")
     */
    public function createAction(Request $request)
    {
        $domain = $request->request->get('domain');

        try {
            if (empty($domain)) {
                throw new ParameterNotFoundException('Invalid Parameter');
            }

            $domain = $this->get('model.domain')->create($domain);

            return $this->jsonResponse('success', 'created', [
                'id'        => $domain->getId(),
                'url'       => $domain->getUrl(),
                'date'      => ['date' => $domain->getDate()->format('Y-m-d')],
                'issuer'    => $domain->getIssuer(),
                'status'    => $domain->getStatus()
            ]);

        } catch (\Exception $e) {
            return $this->jsonResponse('failed', $e->getMessage());
        }
    }

    /**
     * @Route("/list", name="domain_list")
     */
    public function listAction(Request $request)
    {
        $domains = $this->get('doctrine.orm.default_entity_manager')
                        ->getRepository('AppBundle:Domain')
                        ->findAllInArray();

        return new JsonResponse($domains);
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
