<?php
// Le controlleur donne les ordres.
namespace Controller;

use Model\Model;

class Controller{
    private $db;
    //----------- Constructeur : 
    public function __construct()
    {
        if(!file_exists('app/config.xml')) $this->run();
        else $this->db = new Model;
    }

    //----------- Orientation / GET :
    public function handleRequest()
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;
        try
        {
            if($op == 'all') $this->selectAll();
            elseif ($op == 'update') $this->update($op);
            elseif ($op == 'select') $this->select($op);
            elseif ($op == 'save') $this->insert();
            elseif ($op == 'delete') $this->effacer();
            else $this->Error404();

        
        } 
        catch (Exception $e) 
        {
            throw new Exception($e->getMessage());
        }
    }

    public function redirect($location)
    {
        header('Location: '.$location);
    }

    public function Error404()
    {
        $this->render('layout.php', '404.php', array(
            'title' => 'Page non trouvé'
        ));
    }

    //----------- Selection complète : 

    public function selectAll()
    {
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : NULL;
        $this->render('layout.php', 'contacts.php', array(
            'title' => 'Tous les contacts', 
            'contacts' => $this->db->selectAll($orderby),
            'fields' => $this->db->getFields(),
            'id' => 'id_'. $this->db->table
        ));
    }

    //----------- Selection simple :

    public function select()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        $this->render('layout.php', 'contact.php', array(
            'title' => 'Profil', 
            'contact' => $this->db->select($id)
        ));
    }
    //-----------Enregistrement Insert :

    public function insert()
    {

        if($_POST)
        {
            $res = $this->db->insert();
            $this->redirect('index.php?op=all');
        }

        $this->render('layout.php', 'contact-form.php', array(
            'title' => 'Ajout d\'un salarié', 
            'op' => 'insert',
            'fields' => $this->db->getFields()
        ));
    }


    //-----------Enregistrement Upddate :
    public function save($op)
    {
        $title = "$op";

        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $values = ($op == 'update') ? $this->db->select($id) : '';

        if($_POST)
        {
            $res = $this->db->save($op);
        }

        $this->render('layout.php', 'contact-form.php', array(
            'title' => 'Contact', 
            'op' => $op,
            'fields' => $this->db->getFields(),
            'values' => $values
        ));
    }

    public function update($op)
    {
     $id = isset($_GET['id']) ? $_GET['id'] : NULL;   
     $values = ($op == 'update') ? $this->db->select($id) : '';

     if($_POST)
     {
        $res = $this->db->save($op);
        $this->redirect('index.php?op=all');
     }

     $this->render('layout.php', 'contact-form.php', array(
        'title' => 'Modifier un salarié',
        'op' => 'update',
        'fields' => $this->db->getFields(),
        'values' => $values
     ));


    }

     //-----------Effacement (Delete) :

     public function effacer()
     {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $res = $this->db->delete($id);
        $this->redirect('index.php?op=all');

     }

    //----------- View acceuil
    public function run()
    {
        $this->render('layout.php', 'acceuil.php', array(
            'title' => 'Acceuil'
            )
        );
    }


    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);
        ob_start(); // Enclenche la temporisation de sortie, c'est à dire que ce qui suit ne produit pas tout de suite, nous retenons l'affichage pour être totalement MVC - ob_start enclenche la bufferisation de sortie, permet de mettre tout le site en "tampon" avant de l'afficher grâce à un ob_end_flush -- On veut le faire en dernier pour respecter le MVC

        require "View/$template"; // permet de mettre le contenu dans une variable avec la ligne du dessous, l'envoi des données est retenue.

        $content = ob_get_clean(); // le template sera représenter par $content. Cette varible est utilisé dans le layout. $content sera le require. La varaible $content représente le contenu du fichier indiqué par $template.

        ob_start(); // cette ligne est important pour éviter une erreur sous mac et certainement en ligne

        require "View/$layout"; // Explication : ob_start va retenir l'envoie de données et ob_end_flush les liberera en dernier.

        return ob_end_flush(); // Envoie le contenu du tampon de sortie (s'il existe) et éteint la temporisation de sortie. Si vous voulez continuer à manipuler la valeur tampon, vous pouvez appeler ob_get_content() avant ob_end_flush() car le contenu du tampon est détruit après un appel à ob_end_flush(). Termine la temporisation de sortie
    }
}
