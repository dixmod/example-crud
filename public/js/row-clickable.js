document.addEventListener('DOMContentLoaded', function() {
    makeTableRowClickable();
});

function makeTableRowClickable() {
    const TEMPLATE_DETAIL_URL = '/admin/dcService/detail?entityId=';
    let elements = document.getElementsByClassName('js-row-action');

    for (let i = 0; i < elements.length; i++) {
        let td = elements[i];
        let tr = td.parentNode;
        let entityId = tr.getAttribute('data-id');

        if (entityId == null) {
            continue;
        }

        tr.addEventListener('click', function (e) {
            location.href = TEMPLATE_DETAIL_URL + entityId;
        });
    }
}
