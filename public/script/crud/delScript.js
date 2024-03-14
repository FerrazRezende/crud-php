$(document).ready(() => {
    const dialog = $('#del-dialog');
    const modalOpen = $('#del')
    const closeModal = $('#close-modal')

    modalOpen.on({
        click: () => {
            dialog.attr('open', '');
        }
    })

    closeModal.on({
        click: () => {
            dialog.removeAttr('open');
        }
    })
})