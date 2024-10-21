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

    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();

        $.ajax({
            url: 'http://localhost/IDAW/TP4/REST_users.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ name: name, email: email }),
            success: function (response) {
                alert('Utilisateur ajouté avec succès');
                table.ajax.reload();
            },
            error: function () {
                alert('Erreur lors de l\'ajout de l\'utilisateur');
            }
        });
    });

    $('#usersTable').on('click', '.delete-btn', function () {
        var userId = $(this).data('id');

        $.ajax({
            url: `http://localhost/IDAW/TP4/REST_users.php?id=${userId}`,
            type: 'DELETE',
            success: function (response) {
                alert('Utilisateur supprimé');
                table.ajax.reload();
            },
            error: function () {
                alert('Erreur lors de la suppression');
            }
        });
    });

    $('#usersTable').on('click', '.edit-btn', function () {
        var userId = $(this).data('id');
        var newName = prompt('Entrez le nouveau nom');
        var newEmail = prompt('Entrez le nouvel email');

        $.ajax({
            url: `http://localhost/IDAW/TP4/REST_users.php?id=${userId}`,
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({ name: newName, email: newEmail }),
            success: function (response) {
                alert('Utilisateur mis à jour');
                table.ajax.reload();
            },
            error: function () {
                alert('Erreur lors de la mise à jour');
            }
        });
    });
});
