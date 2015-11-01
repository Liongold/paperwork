// Initialise Tour Library
var tour = new Shepherd.Tour({
    defaults: {
        scrollTo: true,
        showCancelLink: true,
        classes: 'shepherd-theme-arrows',
        buttons: [
            {
                text: 'Next',
                events: {
                    'click': function() {
                        $.get("settings/nextTourStep");
                        tour.next();
                    }
                }
            }
        ]
    }
});
// Set Tour Steps
tour.addStep('tour-step-1', {
    text: ['Test Step 0.'],
    title: 'Step 0',
    attachTo: '#menu-item-file bottom',
}); 
tour.addStep('tour-step-2', {
    text: ['Test Step 1.'],
    title: 'Step 1',
    attachTo: '#menu-item-edit bottom',
}); 
// Start Tour
$(document).ready(function() { 
    $("#tour_modal").modal();
    $("#start_tour").click(function() {
        $("#tour_modal").modal("hide");
        tour.start();
        $("div.shepherd-step").css('z-index', 1002);
    });
    $("#start_tour_cancel").click(function() {
        $.get("settings/nextTourStep/9");
    });
});