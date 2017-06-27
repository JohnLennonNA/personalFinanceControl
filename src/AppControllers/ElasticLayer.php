<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 20/05/17
 * Time: 23:53
 */

namespace AppControllers;

use AppControllers\Util;
use Symfony\Component\Config\Definition\Exception\Exception;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ElasticLayer implements ServiceProviderInterface
{
    private $uri = "http://localhost:9200/";
    private $db = "finance";

    public function register(Container $app)
    {
        $app['elastic'] = $this;
    }

    public function defineMethod($ref, $type, $data){

        return $this->{$ref}($data, $type);

    }

    public function listAction($data, $type){

        $response = Util::CurlRequest(
            "{$this->uri}{$this->db}/{$type}/_search",
            $data
        );

        return $response;
    }

    public function insertAction($data, $type){

        $response = Util::CurlRequest(
            "{$this->uri}{$this->db}/{$type}/",
            $data,
            "POST"
        );

        return $response = "";
    }


}