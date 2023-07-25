<?php

class Patient {
    private $numPatient;
    private $nomCompet;
    private $pdo;

    public function __construct($numPatient, $nomCompet) {
        $this->numPatient = $numPatient;
        $this->nomCompet = $nomCompet;
        $this->pdo = new PDO("mysql:localhost;dbname=gestionMedical", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getNumPatient() {
        return $this->numPatient;
    }

    public function getNomCompet() {
        return $this->nomCompet;
    }

    public function save() {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Patient (numPatient, nomCompet) VALUES (:numPatient, :nomCompet)");
            $stmt->execute(array(':numPatient' => $this->numPatient, ':nomCompet' => $this->nomCompet));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function update() {
        try {
            $stmt = $this->pdo->prepare("UPDATE Patient SET nomCompet = :nomCompet WHERE numPatient = :numPatient");
            $stmt->execute(array(':nomCompet' => $this->nomCompet, ':numPatient' => $this->numPatient));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function delete() {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Patient WHERE numPatient = :numPatient");
            $stmt->execute(array(':numPatient' => $this->numPatient));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public static function findAll() {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->query("SELECT * FROM Patient");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($numPatient) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT * FROM Patient WHERE numPatient = :numPatient");
        $stmt->execute(array(':numPatient' => $numPatient));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
