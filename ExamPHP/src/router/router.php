<?php
require 'vendor/autoload.php';

use App\MedicalController;

$controller = new MedicalController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'listerPatients':
            $controller->listerPatients();
            break;
        case 'ajouterPatient':
            if (isset($_POST['numPatient']) && isset($_POST['nomCompet'])) {
                $numPatient = $_POST['numPatient'];
                $nomCompet = $_POST['nomCompet'];
                $controller->ajouterPatient($numPatient, $nomCompet);
            } else {
                echo "Erreur : Paramètres manquants pour l'ajout du patient.";
            }
            break;
        case 'enregistrerRendezVous':
            if (isset($_POST['id']) && isset($_POST['date']) && isset($_POST['etat']) && isset($_POST['patient_numPatient'])) {
                $id = $_POST['id'];
                $date = $_POST['date'];
                $etat = $_POST['etat'];
                $patient_numPatient = $_POST['patient_numPatient'];
                $controller->enregistrerRendezVous($id, $date, $etat, $patient_numPatient);
            } else {
                echo "Erreur : Paramètres manquants pour l'enregistrement du rendez-vous.";
            }
            break;
        case 'listerRendezVous':
            $controller->listerRendezVous();
            break;
        default:
            echo "Erreur : Action non valide.";
    }
} else {
    echo "Erreur : Action non spécifiée.";
}
