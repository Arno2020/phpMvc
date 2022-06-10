<?php 

require_once 'autoload.php';

$controller = new Controller\Controller; // entraine un new ContactService, on se connecte à la BDD

$controller->handleRequest(); // Entraine l'éxecution de la fonction par défault listContacts();

/* handle request = manipulation de la demande (get) ROUTING */