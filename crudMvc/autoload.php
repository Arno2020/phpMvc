<?php

class Autoload
{
    public static $nb = 0;// permet de compter le nom de fois que l'on passe ici
    public static function className($className)
    {

        // echo '<pre>' .self::$nb . ' - Autoload : ' . $className;
        // var_dump($className);
        $tab = explode('\\', $className);// Explode permet de prendre la chaine (string) et de le transformer en un tableau ARRAY. On cherche le caractère \ mais si on en met qu'un seul c'est comme si on voulais échaper la quote(') en php, alors dans ce cas précis il faut mettre 2 anti slash \\.

    //    print '<pre>'; print_r($tab);  print '</pre>';


        if($tab[0] == 'Backoffice'){// L'explode nous permet de savoir si l'on doit reculer d'un dossier pour aller chercher un bundle (c'est à dire un module spécifique)
           
            $path = __DIR__ . '/../src/' . implode('/', $tab) . '.php';// On remet chaque élément du tableau avec un / 
        
        }else{// Sinon on repart forcément de la racine
            $path = __DIR__ . '/' . implode('/', $tab) . '.php';// s'il y a le namespace backoffice je suis dans le if et je vais vers src, sinon je reste dans le else dans le dossier vendor
        }

        // var_dump($path);
        require $path;

        self::$nb++;

    }
}

spl_autoload_register(array('Autoload', 'className'));// Lorque l'on utilise l'autoload sur une class, il faut passer un array et la méthode doit être static.


