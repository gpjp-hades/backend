<?php

namespace controller;

class home {
    
    use \controller\sendResponse;
    
    protected $container;

    function __construct(\Slim\Container $container) {
        $this->container = $container;
    }

    function __invoke($request, $response, $args) {
        $pending    = $this->container->db->select("systems", "*", ["approved" => false]);
        $approved   = $this->container->db->select("systems", "*", ["approved" => true]);
        $categories = $this->container->db->select("categories", "*");

        $response = $this->sendResponse($request, $response, "dashboard.phtml", [
            "pending"    => $pending,
            "approved"   => $approved,
            "categories" => $categories
        ]);
        return $response;
    }
}