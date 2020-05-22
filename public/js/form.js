document.querySelectorAll(".groupe_medecin input").forEach(coco => 
{
    coco.onfocus = function() 
    {
      coco.classList.add("focus");
      coco.style.borderColor="orange";
    }

    coco.onblur = function() 
    {
      if (coco.value === "") 
      {
        coco.classList.remove("focus");
        coco.style.borderColor="white";
      }
    }
});

function verifPrenom(champ)
{
   var regex = /\d{5}/;
   if(!regex.test(champ.value))
   {
     document.querySelector(".groupe_medecin input").style.color="red";
   } else {
     document.querySelector(".groupe_medecin input").style.color="white";
   }
}