

function cacher(objet) {
	objet.style.display = "none";
}


function montrer(objet) {
	objet.style.display = "block";
}



function animationRecherche() {
	var boutton=document.getElementById("bouttonloupe");
	var recherche=document.getElementById("recherche");
	
	var accueil=document.getElementById("menuAccueil");
	var professionels=document.getElementById("menuPro");
	var contact=document.getElementById("menuContact");
	var faq=document.getElementById("menuFAQ");

	if(recherche.style.display=="none"){
		montrer(recherche);
		cacher(accueil);
		cacher(professionels);
		cacher(contact);
		cacher(faq);
	} else {
		cacher(recherche);
		montrer(accueil);
		montrer(professionels);
		montrer(contact);
		montrer(faq);
	}
}
