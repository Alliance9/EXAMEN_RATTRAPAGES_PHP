<?php

class Prestation extends RendezVous {
    private $type;
    private $pdo;

    public function __construct($id, $date, $etat, $patient, $type) {
        parent::__construct($id, $date, $etat, $patient);
        $this->type = $type;
        $this->pdo = new PDO("mysql:localhost;dbname=gestionMedical", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getType() {
        return $this->type;
    }

    public function save() {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Prestation (id, type) VALUES (:id, :type)");
            $stmt->execute(array(':id' => $this->getId(), ':type' => $this->type));
            parent::save();
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function update() {
        try {
            $stmt = $this->pdo->prepare("UPDATE Prestation SET type = :type WHERE id = :id");
            $stmt->execute(array(':type' => $this->type, ':id' => $this->getId()));
            parent::update(); // Call the update() method from the parent class to update the common data
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function delete() {
        try {
            parent::delete(); // Call the delete() method from the parent class to delete the common data
            $stmt = $this->pdo->prepare("DELETE FROM Prestation WHERE id = :id");
            $stmt->execute(array(':id' => $this->getId()));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public static function findAll() {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->query("SELECT * FROM Prestation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT * FROM Prestation WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
