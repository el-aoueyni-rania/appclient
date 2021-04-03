<?php

require 'database.class.php';

class Client
{
    private $pdo;

    public function __construct()
    {
        $conn = new Database();
        $this->pdo = $conn->getConnection();
    }

    public function getAllClients()
    {
        try {
            $sql = "SELECT * FROM client";
            $query = $this->pdo->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOneClient($id)
    {
        try {
            $sql = "SELECT * FROM client WHERE id = ?";
            $query = $this->pdo->prepare($sql);
            $query->execute([$id]);
            return $query;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addNewClient($nom, $prenom, $dateNaissance, $address, $tel)
    {
        try {
            $sql = "
                INSERt INTO client(nom, prenom, datenaissance, adresse, tel)
                VALUES (?, ?, ?, ?, ?)
                ";
            $query = $this->pdo->prepare($sql);
            $query->execute([$nom, $prenom, $dateNaissance, $address, $tel]);
            return $query;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateClient($id, $nom, $prenom, $dateBirth, $adr, $tel)
    {
        try {
           
            $sql = 'UPDATE client
                    SET nom = ?,
                        prenom = ?,
                        datenaissance = ?,
                        adresse = ?,
                        tel = ?
                    WHERE id = ?';
            $result = $this->pdo->prepare($sql);
            $result->execute([$nom, $prenom, $dateBirth, $adr, $tel, $id]);
            return $result;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function deleteClient($id)
    {
        try {
            $sql = 'DELETE FROM client WHERE id = :clt_id';
            $result = $this->pdo->prepare($sql);
            $result->bindparam(":clt_id", $id);
            $result->execute();
            return $result;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}
