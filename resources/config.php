<?php

// Config file for constants

$config = array(
    "db" => array(
        "dev" => array(
            "dbname" => "quotes",
            "username" => "server",
            "password" => "CSCI467S3rverAuth2019",
            "host" => "cnet.brettcarney.com"
        ),
        "legacy" => array(
            "dbname" => "b25oudnru9u3blk4",
            "username" => "rs0czd6o8w8e8r3j",
            "password" => "w1ffboir25orrcs4",
            "host" => "er7lx9km02rjyf3n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com"
        )
    ),
    "urls" => array(
        "legacyURL" => "http://blitz.cs.niu.edu/CreditCard/"
    ),
    "paths" => array(
        "resources" => "/resources",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "public_html/img/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "public_html/img/layout"
        )
    )
);
 
/*
    Constants for heavily used paths
*/
defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 
?>