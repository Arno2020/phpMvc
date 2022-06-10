<?php
namespace model;

use PDO, PDOException;


class Model
{
    private $db;
    private $table;
    public function __construct(){}

    public function getDB()
    {
        if(!$this->db)
        {
            try{
                $xml = simplexml_load_file('app/config.xml'); 
                // var_dump($xml);
                $this->table = $xml->table;
                try{
                    $this->db = new \PDO(
                        "mysql:dbname=" . $xml->db . ";host=" . $xml->host,
                         $xml->user, 
                         $xml->password, 
                         array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION)
                    );
                }
                catch(\PDOException $e){
                    die("Probleme de connexion BDD : " . $e->getMessage());
                }


            }
            catch(Exception $e){
                die('probleme de fichier xml manquant');
            }

        }
        return $this->db;
    }

    public function selectAll()
    {
        $q = $this->getDb()->query('SELECT * FROM ' . $this->table);
        $r = $q->fetchAll(\PDO::FETCH_OBJ);
        if(!$r){
            return false;
        }
        else{
            return $r;
        }
    }

    public function select($id)
    {
        $q = $this->getDb()->query('SELECT * FROM ' . $this->table . ' WHERE id_' . ($this->table) . '= ' . (int) $id);
        // SELECT * FROM employes WHERE id_employes = 415;
        $r = $q->fetch(PDO::FETCH_OBJ);

        if(!$r){
            return false;
        }
        else{
            return $r;
        }
    }


    public function delete($id)
    {
        $q = $this->getDb()->query('DELETE FROM ' . $this->table . ' WHERE id_' . $this->table . '= ' . (int) $id);
    }

    public function insert()
    {

        // var_dump($_POST);

        echo 'INSERT INTO ' . $this->table . '(' . implode(',', array_keys($_POST)) . ') VALUES (' . "'" . implode("','", $_POST) . "'" . ')';

        // 'INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES (jean, bord, masc, comptabilité, 05-02-2022, 3500)
        $q = $this->getDb()->query('INSERT INTO ' . $this->table . '(' . implode(',', array_keys($_POST)) . ') VALUES (' . "'" . implode("','", $_POST) . "'" .')');
        // var_dump($this);
    }



}