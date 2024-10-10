$(document).ready(() => {
    const closeButton = $('#close-up-modal');
    const modal = $('#update-modal');
    const editButton = $('.edit')

    editButton.on({
        click: () => {
            modal.attr('open', '');
        }
    })

    closeButton.on({
        click: () => {
            modal.removeAttr('open');
        }
    })
})