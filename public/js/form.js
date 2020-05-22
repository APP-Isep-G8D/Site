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

toto = document.querySelector(".groupe_medecin select"); 
toto.onfocus = function() 
{
  toto.classList.add("focus");
  toto.style.borderColor="orange";
}

toto.onblur = function() 
{
  if (toto.value === "") 
  {
    toto.classList.remove("focus");
    toto.style.borderColor="white";
  }
}