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
            $sql = "SELECT * FROM clients";
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
            $sql = "SELECT * FROM clients WHERE id = ?";
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
                INSERt INTO clients(nom, prenom, datenaissance, adresse, tel)
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
            // $sql = 'UPDATE clients
            //         SET nom = :clt_nom,
            //             prenom = :clt_prenom,
            //             datenaissance = :clt_dateN,
            //             adresse = :clt_adr,
            //             tel = :clt_tel
            //         WHERE id = :clt_id';
            // $result = $this->pdo->prepare($sql);
            // $result->bindparam(":clt_id", $id);
            // $result->bindparam(":clt_nom", $nom);
            // $result->bindparam(":clt_prenom", $prenom);
            // $result->bindparam(":clt_dateN", $dateBirth);
            // $result->bindparam(":clt_adr", $adr);
            // $result->bindparam(":clt_tel", $tel);
            // $result->execute();
            // ou bien
            $sql = 'UPDATE clients
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
            $sql = 'DELETE FROM clients WHERE id = :clt_id';
            $result = $this->pdo->prepare($sql);
            $result->bindparam(":clt_id", $id);
            $result->execute();
            return $result;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}
