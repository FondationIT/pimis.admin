$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//setInterval(notification, 3000);
//setInterval(message, 3000);

function loopAjax() {
    $.ajax({
        url: 'home',
        type: 'Post'
    }).done(function (data) {
        console.log(JSON.parse(data)) // Quand la requête réussi et retourne un 2XX
    }).fail(function (err) {
            console.log(err) // Quand la requête échoue ou retourne un 4XX ou 5XX
    }).always(function () {
        // Quelque soit le résultat il passe dans cette fonction
        setTimeout(function () {
        loopAjax()
        }, 1000) // Quand la requête est finis on attends 1 seconde et on relance la fonction
    })
}

loopAjax()
