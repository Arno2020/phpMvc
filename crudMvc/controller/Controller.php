<?php

namespace controller;

use model\Model;
use Exception;

class Controller{
    private $db;
    public function __construct(){
        // $this->contactsService = new ContactsService();
        $this->db = new Model;
        $e = new Error; 
    }

    public function redirect($location) {
        header('Location: '.$location);
    }

    public function handleRequest(){
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;
        try{
            if(!$op || $op == 'list'){
                $this->listContacts();
            }
            elseif($op == 'show'){
                $this->showContact();
            }
            elseif($op == 'delete'){
                $this->deleteContact();
            }
            elseif($op == 'new'){
                $this->saveContact();
            }
  
        }catch(\Exception $e){
            $this->showError("Invalide URL", $e->getMessage());
        }
    }

    public function listContacts(){
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL; //Ici j'affine ma requete sql avec orderby
        $contacts = $this->db->selectAll($orderby);// Ici je récupère la methode selectAll(Je lui passe en argument l'affinage de ma requete) faite dans model/Model.php
        include 'view/contact.php'; //J'envoie tous dans view/contact.php qui va afficher dans mon navigateur
    }

    public function showContact(){
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if (!$id){
            throw new Exception('Internal error');
        }
        $contact = $this->db->select($id);

        include 'view/contact-single.php';
    }

    public function deleteContact(){
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        if(!$id)
        {
            throw new Exception('Internal error.');
        }
        $res = $this->db->delete($id);

        $this->redirect('index.php');
    }

    public function saveContact()
    {
        $title = 'Add new contact'; 

        $prenom = '';
        $nom = '';
        $sexe = '';
        $service = '';
        $date_embauche = '';
        $salaire = '';

        $errors = array();

        if($_POST){
            $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
            $nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
            $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : NULL;
            $service = isset($_POST['service']) ? $_POST['service'] : NULL;
            $date_embauche = isset($_POST['date_embauche']) ? $_POST['date_embauche'] : NULL;
            $salaire = isset($_POST['salaire']) ? $_POST['salaire'] : NULL;

            try{
                $res = $this->db->insert();
                $this->redirect('index.php');
                return;
            }catch (Exception $e){
                echo 'erreur sql';
            }


        }

        include 'view/contact-form.php';


    }

    public function showError($e){
        
        echo $e;
    }



    

    
}
