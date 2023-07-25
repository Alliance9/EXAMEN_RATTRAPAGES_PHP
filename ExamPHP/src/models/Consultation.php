<?php

class Consultation extends RendezVous {
    private $medecin;
    private $medicament;
    private $pdo;

    public function __construct($id, $date, $etat, $patient, $medecin, $medicament) {
        parent::__construct($id, $date, $etat, $patient);
        $this->medecin = $medecin;
        $this->medicament = $medicament;
        $this->pdo = new PDO("mysql:localhost;dbname=gestionMedical", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getMedecin() {
        return $this->medecin;
    }

    public function getMedicament() {
        return $this->medicament;
    }

    public function save() {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Consultation (id, medecin, medicament) VALUES (:id, :medecin, :medicament)");
            $stmt->execute(array(
                ':id' => $this->getId(),
                ':medecin' => $this->medecin,
                ':medicament' => implode(',', $this->medicament)
            ));
            parent::save();
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function update() {
        try {
            $stmt = $this->pdo->prepare("UPDATE Consultation SET medecin = :medecin, medicament = :medicament WHERE id = :id");
            $stmt->execute(array(
                ':medecin' => $this->medecin,
                ':medicament' => implode(',', $this->medicament),
                ':id' => $this->getId()
            ));
            parent::update(); // Call the update() method from the parent class to update the common data
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function delete() {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Consultation WHERE id = :id");
            $stmt->execute(array(':id' => $this->getId()));
            parent::delete(); // Call the delete() method from the parent class to delete the common data
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public static function findAll() {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->query("SELECT * FROM Consultation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT * FROM Consultation WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
