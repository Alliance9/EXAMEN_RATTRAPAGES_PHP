<?php
require_once 'Patient.php';
require_once 'RendezVous.php';
require_once 'Prestation.php';
require_once 'Consultation.php';

class MedicalController {
    public function listerPatients() {
        $patients = Patient::findAll();
        return $patients;
    }

    public function ajouterPatient($numPatient, $nomCompet) {
        $patient = new Patient($numPatient, $nomCompet);
        if ($patient->save()) {
            echo "Le patient a été ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du patient.";
        }
    }

    public function enregistrerRendezVous($id, $date, $etat, $patient_numPatient) {
        $patient = Patient::findById($patient_numPatient);
        if (!$patient) {
            echo "Le patient avec le numéro de patient '$patient_numPatient' n'existe pas.";
            return;
        }

        $rendezVous = new RendezVous($id, $date, $etat, $patient);
        if ($rendezVous->save()) {
            echo "Le rendez-vous a été enregistré avec succès.";
        } else {
            echo "Erreur lors de l'enregistrement du rendez-vous.";
        }
    }

    public function listerRendezVous() {
        $rendezVous = RendezVous::findAll();
        return $rendezVous;
    }
}
