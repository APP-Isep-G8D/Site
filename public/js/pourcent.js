document.querySelectorAll(".complétion").forEach(coco => {
    
        var $chargement, perc, start, update;

        $chargement = $('.complétion');

        perc = 0;

        update = function () {
            $chargement.css("width", perc + '%');
            $chargement.attr("perc", Math.floor(perc) + '%');
            perc += 0.2;
            if (Math.floor(perc) === 5) {
                $chargement.addClass('active');
            }
            if (Math.floor(perc) === 95) {
                $chargement.removeClass('active');
            }
            if (perc >= 100) {
                return perc = 0;
            }
        };

        start = function () {
            var run;
            return run = setInterval(update, 10);
        };

        start();

    
});