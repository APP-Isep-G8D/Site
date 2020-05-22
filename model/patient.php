<?php

function isPatient()
{
    if (isConnected()) {
        $bdd = dbConnect();
        $user = userFromSession($bdd);
        if ($user->role == "patient") {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function verifyAcessPatient($bdd, $user)
{
    if (isset($_SESSION['idUtilisateur'])) {

        $value = $bdd->prepare("SELECT * FROM patient WHERE idUtilisateur = ?");
        $value->bind_param('s', $user->idUtilisateur);
        $value->execute();
        $result = $value->get_result();
        $patient = $result->fetch_object();

        $idTest = $_GET["idTest"];
        $value = $bdd->prepare("SELECT * FROM test WHERE idTest = ?");
        $value->bind_param('s', $idTest);
        $value->execute();
        $result = $value->get_result();
        $test = $result->fetch_array();

        if ($user->role == "patient" && $test["idPatient"] == $patient->idPatient) {
            return true;
        } else {
            return false;
        }
    } else {
        // Redirect them to the login page
        return false;
    }
}

function getListTestsPatient($bdd)
{
    $listeTests = array();
    $tests = $bdd->prepare("SELECT * FROM test WHERE idPatient=?");
    $tests->bind_param('s', $_GET["idP"]);
    $tests->execute();
    $testR = $tests->get_result();
    while ($test = $testR->fetch_array()) {
        array_push($listeTests, $test);
    }
    return $listeTests;
}


function getTestResultsPatient($bdd)
{
    $testResults = array();
    $idTest = $_GET["idTest"];


    $testQ = $bdd->prepare("SELECT * FROM test  WHERE idTest = ?");
    $testQ->bind_param('s', $idTest);
    $testQ->execute();
    $testR = $testQ->get_result();
    $test = $testR->fetch_array();

    $mesuresQ = $bdd->prepare("SELECT * FROM mesure  WHERE idTest = ?");
    $mesuresQ->bind_param('s', $idTest);
    $mesuresQ->execute();
    $mesuresR = $mesuresQ->get_result();
    $mesures = $mesuresR->fetch_array();

    array_push($testResults, $mesures);
    array_push($testResults, $test);
    return $testResults;
}

function getPatientbyId($id, $bdd)
{
    $patientRQ = $bdd->prepare("SELECT * FROM patient WHERE idUtilisateur= ?");
    $patientRQ->bind_param('s', $id);
    $patientRQ->execute();
    $patientR = $patientRQ->get_result();
    $patient = $patientR->fetch_array();
    return $patient;
}
