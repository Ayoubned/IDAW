$(document).ready(function () {
    var table = $('#usersTable').DataTable({
        ajax: {
            url: 'http://localhost/IDAW/TP4/REST_users.php',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="edit-btn" data-id="${data.id}">Modifier</button>
                        <button class="delete-btn" data-id="${data.id}">Supprimer</button>
                    `;
                }
            }
        ]
    });
});
