<?php 

class Autoload
{
    public static function className($className)
    {
        // echo __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
        require __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    }
}

spl_autoload_register(array('Autoload', 'className')); // Lorsque l'on utilise l'autoload sur une classe, il faut passer un array et la méthode doit être static.
