function move() {


    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width = width + 0.2;
            elem.style.width = width + '%';
            elem.innerHTML = Math.round(width) + '%';
        }
    }
}

window.onload = function () {
    this.setTimeout(this.move, 1500)
}