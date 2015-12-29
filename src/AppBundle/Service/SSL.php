<?php

namespace AppBundle\Service;

class SSL
{
    /**
     * @var array
     */
    private $certInfo;

    /**
     * @param $url String
     */
    public  function init($url)
    {
        $parse = parse_url($url, PHP_URL_HOST);

        $get            = stream_context_create(["ssl" => ["capture_peer_cert" => true]]);
        $read           = stream_socket_client("ssl://".$parse.":443", $errno, $err, 30, STREAM_CLIENT_CONNECT, $get);
        $cert           = stream_context_get_params($read);
        $this->certInfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

        if (! is_array($this->certInfo)) {
            throw new \InvalidArgumentException('cannot get ssl certificate information');
        }
    }

    /**
     * @return DateTime
     */
    public function getExiprationDate()
    {
        $ts = $this->certInfo['validTo_time_t'];
        return new \DateTime("@$ts");
    }

    /**
     * @return array
     */
    public function getIssuer($info = null)
    {
        if (! isset ($this->certInfo['issuer'][$info])) {
            return $this->certInfo['issuer'];
        }

        return $this->certInfo['issuer'][$info];
    }

    /**
     * @return array
     */
    public function getCertInfo()
    {
        return $this->certInfo;
    }

}