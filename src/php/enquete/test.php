<?php


require 'EnqueteManager.php';

$enquete = new EnqueteManager();



echo "<pre>";
var_dump($enquete->chargerEnquete());
echo "</pre>";
