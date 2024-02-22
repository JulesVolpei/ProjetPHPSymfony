$(document).ready(function() {
    let saladFruit = $('.saladfruit');
    if (saladFruit.length > 0) {
        saladFruit.eq(0).click(function() {
            alert('titi');
        });
    }
});