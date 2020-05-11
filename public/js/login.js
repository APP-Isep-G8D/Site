
    document.querySelectorAll(".input_container input").forEach(coco => {
        coco.onfocus = function() {
          coco.classList.add("focus");
        }
    
        coco.onblur = function() {
          if (coco.value === "")
            coco.classList.remove("focus");
        }
      });

