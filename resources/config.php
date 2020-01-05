<?php

// Config file for constants

$config = array(
    "db" => array(
        "dev" => array(
            "dbname" => "",
            "username" => "",
            "password" => "",
            "host" => ""
        ),
        "legacy" => array(
            "dbname" => "",
            "username" => "",
            "password" => "",
            "host" => ""
        )
    ),
    "urls" => array(
        "legacyURL" => ""
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
     
defined("RESOURCES_PATH")
    or define("RESOURCES_PATH", realpath(dirname(__FILE__)));
 
$_SERVER["DOCUMENT_ROOT"] = "QUOTE_SYSTEM/";
?>
