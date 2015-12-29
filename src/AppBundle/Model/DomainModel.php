<?php

namespace AppBundle\Model;


use AppBundle\Entity\Domain;
use AppBundle\Service\SSL;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DomainModel
 * @package AppBundle\Model
 */
class DomainModel
{
    private $ssl;

    private $em;

    /**
     * @param SSL $ssl
     */
    public function __construct(SSL $ssl, EntityManagerInterface $em)
    {
        $this->ssl = $ssl;
        $this->em  = $em;
    }

    /**
     * @param $url String
     */
    public function create($url)
    {
        $this->ssl->init($url);

        $domain = new Domain();
        $domain->setUrl($url);
        $domain->setDate($this->ssl->getExiprationDate());
        $domain->setIssuer($this->ssl->getIssuer('CN'));

        $this->em->persist($domain);
        $this->em->flush();

        return $domain;
    }
}