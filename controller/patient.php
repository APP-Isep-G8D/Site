<?php
require('model/patient.php');

function patient()
{
    if (isPatient()) {
        $bdd = dbConnect();
        $user = userFromSession($bdd);
        $patient = getPatientbyId($user->idUtilisateur, $bdd);
        $idCentre = $patient["idCentre"];
        $idP = $patient["idPatient"];
        $listeTests = getListTestsPatient($bdd);
        require("view/patient/patient.php");
    } else {
        redirect();
    }
}
