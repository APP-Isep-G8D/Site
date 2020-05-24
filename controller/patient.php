<?php
require('model/patient.php');

function patient()
{
    if (isPatient()) {
        $bdd = dbConnect();
        $user = userFromSession($bdd);
        $patient = getPatientbyId($user->idUtilisateur, $bdd);


        $listeTests = getListTestsPatient($bdd, $patient);
        require("view/patient/patient.php");
    } else {
        redirect();
    }
}
