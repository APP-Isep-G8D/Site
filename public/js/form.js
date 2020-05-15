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