<?php


require 'EnqueteManger.php';

$enquete = new EnqueteManger();


echo "<pre>";
var_dump($enquete->chargerEnquete());
echo "</pre>";
