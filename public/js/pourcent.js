var maxBarre = 1000;
var completion = 0;
var progressBarre;
var intervalId;

var initialisation = function () {
    progressBarre = document.getElementById("progressBarre");
    progressBarre.value = completion;
    progressBarre.max = maxBarre;
}

var displayBarre = function () {
    completion++;
    if (completion > maxBarre) {
        clearInterval(intervalId);
    }
    progressBarre.value = completion;
}

window.onload = function () {
    initialisation();
    intervalId = setInterval(displayBarre, 10);
}