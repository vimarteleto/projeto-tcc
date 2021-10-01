
function statusChange() {

    let id = $(".custom-control-input").data('id')
    let route = $(".custom-control-input").data('route')

    $.post(`${route}/status/${id}`, (data) => {
        console.log(data)
    })
    
}
