const DevelopmentRequest = function(indicator){
    $.ajax({
        url: '/api/dev/status',
        type: 'GET',dataType: 'json',
        success: function(response) {
            if (response.status) {
                indicator.show();
                if(response.refresh){
                    window.location.reload();
                }
            } else {
                indicator.hide();
            }
        },
    });
}
const DevelopmentStatus = function(){

    // Create a visual indicator
    const indicator = $(document.createElement('i')).attr({
        "id": "dev-indicator",
        "class": "position-fixed start-50 translate-middle-x bi bi-gear-wide text-info animate-fade",
        "style": "z-index:9999;font-size:5rem;bottom: 64px;"
    }).prependTo('body');

    // Hide the indicator by default
    indicator.hide();

    // Request the dev status every 10seconds
    setInterval(function(){
        DevelopmentRequest(indicator);
    }, 10000);

    // Initial request
    DevelopmentRequest(indicator);
}

// Initialize the dev status check
$( document ).ready(function() {
    DevelopmentStatus();
});
