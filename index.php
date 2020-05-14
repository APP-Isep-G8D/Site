
<?php
session_start();
require('controller/frontend.php');
require('controller/admin.php');
require('controller/medecin.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'main') {
        main();
    }
    elseif ($_GET['action'] == 'faq') {
        faq();
    }
    elseif ($_GET['action'] == 'contactus') {
        contactus();
    }
    elseif ($_GET['action'] == 'Professionnel') {
        professionnel();
    }
    elseif ($_GET['action'] == 'SAV') {
        sav();
    }
    elseif ($_GET['action'] == 'CGU') {
        cgu();
    }
    elseif ($_GET['action'] == 'envoiMail') {
        envoiMail();
    }
    elseif ($_GET['action'] == 'patienter') {
        patienter();
    }
    elseif ($_GET['action'] == 'logout') {
        logout();
    }
    elseif ($_GET['action'] == 'login') {
        login();
    }
    elseif ($_GET['action'] == 'redirect') {
        redirect();
    }
    elseif ($_GET['action'] == 'admin') {
        admin();
    }
    elseif ($_GET['action'] == 'centre') {
        centre();
    }
    elseif ($_GET['action'] == 'ajoutBoitier') {
        ajoutBoitier();
    }
    elseif ($_GET['action'] == 'verifDelBoitier') {
        verifDelBoitier();
    }
    elseif ($_GET['action'] == 'medSupp') {
        verifDelMedecin();
    }
    elseif ($_GET['action'] == 'ajoutMedecin') {
        ajoutMedecin();
    }
    elseif ($_GET['action'] == 'verifDelCentre') {
        verifDelCentre();
    }
    elseif ($_GET['action'] == 'ajoutCentre') {
        ajoutCentre();
    }
    elseif ($_GET['action'] == 'delCentre') {
        if (isset($_GET['id']) && centreExist($_GET['id'])) {
            delCentre($_GET["id"]);
        }
        else {
            main();
        } 
    }
    elseif ($_GET['action'] == 'removeBoitier') {
        removeBoitier();
    }
    elseif ($_GET['action'] == 'removeMedecin') {
        removeMedecin();
    }
    elseif ($_GET['action'] == 'medecin') {
        medecin();
    }
    elseif ($_GET['action'] == 'profilPatient') {
        profilPatient();
    }
    
    elseif ($_GET['action'] == 'test') {
        test();
    }
    elseif ($_GET['action'] == 'newTest') {
        newTest();
    }
    elseif ($_GET['action'] == 'ajoutPatient') {
        ajoutPatient();
    }
    elseif ($_GET['action'] == 'testEnCours') {
        testEnCours();
    }
    
    else{
        error();
    }
}
else {
    main();
}