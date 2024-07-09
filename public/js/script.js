function loadFile (event, id) {
    let image = document.querySelector('#' + id)
    image.src = URL.createObjectURL(event.target.files[0]);
}
function changeStatus(id, model, token, route) {
    fetch(route, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'X-CSRF-Token': token
        },
        body: JSON.stringify({
            id,
            model
        })
    });
}
