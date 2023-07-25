<?php


class RendezVous {
    private $id;
    private $date;
    private $etat;
    private $patient;
    private $pdo;

    public function __construct($id, $date, $etat, $patient) {
        $this->id = $id;
        $this->date = $date;
        $this->etat = $etat;
        $this->patient = $patient;
        $this->pdo = new PDO("mysql:localhost;dbname=gestionMedical", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE);
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getPatient() {
        return $this->patient;
    }

    public function save() {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO RendezVous (id, date, etat, patient_numPatient) VALUES (:id, :date, :etat, :patient_numPatient)");
            $stmt->execute(array(
                ':id' => $this->id,
                ':date' => $this->date,
                ':etat' => $this->etat,
                ':patient_numPatient' => $this->patient->getNumPatient()
            ));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function update() {
        try {
            $stmt = $this->pdo->prepare("UPDATE RendezVous SET date = :date, etat = :etat, patient_numPatient = :patient_numPatient WHERE id = :id");
            $stmt->execute(array(
                ':date' => $this->date,
                ':etat' => $this->etat,
                ':patient_numPatient' => $this->patient->getNumPatient(),
                ':id' => $this->id
            ));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function delete() {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM RendezVous WHERE id = :id");
            $stmt->execute(array(':id' => $this->id));
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public static function findAll() {
        $pdo = new PDO("mysql:host=your_host;dbname=your_db_name", "your_username", "your_password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT * FROM RendezVous");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        $pdo = new PDO("mysql:host=your_host;dbname=your_db_name", "your_username", "your_password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM RendezVous WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
