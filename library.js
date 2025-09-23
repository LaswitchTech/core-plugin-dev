API.success(function(response, endpoint){
    if(response.app.development){
        if(!$('i[data-dev-mode]').length){
            $(document.createElement('i')).attr({"data-dev-mode": response.app.development,"class": "position-fixed start-50 translate-middle-x bi bi-gear-wide text-info animate-fade", "style": "z-index:9999;font-size:5rem;bottom: 64px;"}).prependTo('body');
            builder.Toast.add({
                color: 'info',
                icon: 'info-circle',
                title: builder.Locale.get('Development Mode'),
                body: builder.Locale.get('The application is currently running in development mode.'),
            });
        }
    } else {
        $('i[data-dev-mode]').remove();
    }
});
