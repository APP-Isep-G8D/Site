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
popo = document.querySelector(".groupe_medecin span");
toto = getComputedElement(popo,"::before");
toto.style.color = "orange";

/*
document.querySelectorAll(".groupe_medecin").forEach(tailleInput =>
{
  tailleInput.onfocus = function() 
  {
    tailleInput.style.color="orange";
  }

  tailleInput.onblur = function() 
  {
    if (tailleInput.value === "") 
    {
      tailleInput.style.color="white";
    }
  }
});
*/
