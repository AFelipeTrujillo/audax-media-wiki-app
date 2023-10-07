$( document ).ready(() => {
    $('.basicAutoComplete').autoComplete({
        resolverSettings: {
            url: 'list.json'
        }
    });

    $('.basicAutoComplete').on('autocomplete.select', function (evt, item) {
        $.post('/term/create', {term : item})
        .done(function(data){
            alert("The term " + item + " has been created in database")
        })
        .fail(function(data){
            if(data.responseJSON.code == 23000){
                alert('ERROR: ' + data.responseJSON.code + ' - This term exists in database');
            }
        })
    });
})