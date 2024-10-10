$(document).ready(function() {
    const alert = $('.alert')

    alert.fadeTo(2000, 500).slideUp(500, function() {
        alert.slideUp(500)
    })
})