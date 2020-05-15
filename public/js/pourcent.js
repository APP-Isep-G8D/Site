function move() {
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
            this.va_et_vient();
        } else {
            width = width + 0.2;
            elem.style.width = width + '%';
            elem.innerHTML = Math.round(width) + '%';
        }
    }
}

function va_et_vient() {
    if (document.getElementById("recommencer_test").style.display == 'none') {
        document.getElementById("recommencer_test").style.display = 'inline';
        ;
    }
    else {
        document.getElementById("recommencer_test").style.display = 'none';
    }
}

window.onload = function () {
    this.va_et_vient();
    this.setTimeout(this.move, 1500);
    
}