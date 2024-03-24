$(document).ready(() => {
    const btnDel = $("#btn-delete")
    const markx = $(".checkbox-del")
    const btnAdd = $("#btn-add")
    const textAdd = $("#text-obs")

    marxAc = false

    btnDel.on({
        click: () => {
            marxAc = !marxAc
            if (marxAc) {
                markx.css({
                    visibility: "visible"
                })
            }
            else {
                markx.css({
                    visibility: "hidden"
                })
            }
        }
    })

    btnAdd.on({
        click: () => {
            textAdd.toggle()
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        }
    })

})