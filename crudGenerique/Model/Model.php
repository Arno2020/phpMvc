<?php
// Model que l'on peut appeller aussi repository, centralise tout ce qui touche à la récupération des vos entitées. Concrètrement donc, vous ne devez pas faire la moindre requète SQL ailleurs que dans un repository (=Model), c'est la règle.
// EntityRepository(Model) ne connait pas "employes" ou autre, il connait que des entitées. Cela doit rester générique afin que le code soir ré-utilisable.

namespace model;

use PDO, PDOException;


class Model
{
    private $db;
    public $table;
    public function __construct(){}

    // Ici nous faisons la connexion a la base de donnée via un fichier .XML
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

    public function getFields()
    {
        $q = $this->getDB()->query('DESC ' . $this->table);
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        return array_slice($r,1); // on retourne tout sauf la colonne id.  
    }

    public function selectAll()
    {
        // SELECT * FROM `employes`
        $q = $this->getDb()->query('SELECT * FROM ' . $this->table);// Je prepare ma requete sql
        $r = $q->fetchAll(PDO::FETCH_ASSOC);// Je demande que le resultat soit sous forme de tableau (FETCH_ASSOC);
        // var_dump($r); die();
        return $r;
    }

    public function select($id)
    {
        // SELECT * FROM `employes` WHERE id_employes = 10
        $q = $this->getDb()->query('SELECT * FROM ' . $this->table . ' WHERE id_' . $this->table . '= ' . (int) $id);
        $r = $q->fetch(PDO::FETCH_ASSOC); 
        return $r;
    }

    public function save($op)
    { 
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
        // REPLACE INTO `employes` (id_employes, nom, prenom, sexe, service, salaire, date_embauche  ) VALUES (10, 'Martin','Jean','m','comptabilité','2500','2022-06-10')
        $q = $this->getDb()->query('REPLACE INTO ' . $this->table . '(id_' . ($this->table) . ',' .implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');
        // var_dump($q); die();        
    }

    public function insert()
    {
        // INSERT INTO `employes` (nom, prenom, sexe, service, salaire, date_embauche) VALUES ('Martin','Jean','m','comptabilité','2500','2022-06-10')
        $q = $this->getDb()->query('INSERT INTO ' . $this->table . '(' .implode(',', array_keys($_POST)) . ') VALUES (' . "'" . implode("','", $_POST) . "'" .')');
    }

    public function delete($id)
    {
        // DELETE FROM `employes` WHERE id_employes = 10
        $q = $this->getDb()->query('DELETE FROM ' . $this->table . ' WHERE id_' . $this->table . '= ' . (int) $id);
    }




}