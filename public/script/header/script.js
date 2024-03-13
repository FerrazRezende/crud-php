$(document).ready(() => {
    const search = $('#search')
    const searchInput = $('#searchinput')
    const button = $('#meubtn')

    search.on({
        click: () => {
            searchInput.toggle();
        },
    })

    searchInput.on({
        keyup: () => {
            if (searchInput.val().trim() !== '') {
                button.show()
            } else {
                button.hide()
            }
        }
    })
});