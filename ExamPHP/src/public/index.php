<?php

require 'vendor/autoload.php'; 

use App\MedicalController;

$controller = new MedicalController();

$controller->listerPatients();

// $controller->enregistrerRendezVous(1, '2023-08-15', 'Encours', 'SAMU001');

$controller->listerRendezVous();
