$(document).ready(function() {
    let saladFruit = $('#saladfruitConnected');
    if (saladFruit.length > 0) {
        saladFruit.click(function() {
            getRandomFruit();
        });
    }
});

function getRandomFruit() {
    $.ajax({
        url: "/ajax/random_select",
    }).done(function( data ) {
        window.location.href = '/list_query/'+data+'/page-1'
      })
}