<?php

namespace AppBundle\Entity;

/**
 * Domain
 */
class Domain
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $issuer;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $status;


    /**
     * @var array
     */
    private $acceptedStatus;

    /**
     *
     */
    public function __construct()
    {
        $this->acceptedStatus = ['active', 'inactive', 'delete'];
        $this->setStatus('active');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Domain
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set issuer
     *
     * @param string $issuer
     *
     * @return Domain
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Get issuer
     *
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Domain
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Domain
     */
    public function setStatus($status)
    {
        if (! in_array($status, $this->acceptedStatus)) {
            throw new \InvalidArgumentException(sprintf("status: '%s' not accepted", $status));
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}

