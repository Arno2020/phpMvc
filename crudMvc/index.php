<?php 

require_once 'autoload.php';


$controller = new controller\Controller();// entraine un new ContactsService, on se connecte à la bdd
$controller->handleRequest(); 
