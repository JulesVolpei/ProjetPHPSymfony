$(document).ready(function() {
    let searchBar = $('.input[type="search"]')
    if (searchBar.length > 0) {
        searchBar.on('input',function(elem) {
            getFruitData(elem.currentTarget.value)
        });
    }
});

function getFruitData(input) {
    let autocompletion = $('.autocompletion');
    switch (input) {
        case '':
            autocompletion.hide();

            break;
    
        default:
            $.ajax({
                url: "/ajax/fruit_list/"+input,
            }).done(function( data ) {
                autocompletion.html(data);
            });

            autocompletion.show();

            break;
    }

}