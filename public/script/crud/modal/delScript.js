$(document).ready(function() {
    const dialog = $('#del-dialog');
    const modalOpen = $('.del')
    const closeModal = $('.close-modal')
    const delConfirm = $('#del-confirm')


    modalOpen.on({
        click: function() {


            var deleteUrl = $(this).data('delete-url');
            delConfirm.data('delete-url', deleteUrl);
            dialog.attr('open', '');
        }
    })

    closeModal.on({
        click: () => {
            dialog.removeAttr('open');
        }
    })
})