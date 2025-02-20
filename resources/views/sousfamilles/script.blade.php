<script>
    // Example: Setting values before showing the modal
    function showItemDetails(item) {
        document.getElementById('showLibelle').innerText = item.libelle;
        document.querySelector('#showImage img').src = `storage/${item.image}`;
        // Optionally set the hidden id field
        document.getElementById('id').value = item.id;
    }

    function showSuccessAlert(message) {
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            animation: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    }
    // Create/Edit Modal Handler
    $('#createNewItem').click(function() {
        $('#id').val('');
        $('#itemForm').trigger("reset");
        $('#modalTitle').html("Ajouter nouvelle sous famille");
        $('#saveBtn').html("Ajouter");
        // $('#itemModal').modal('show');
        $('#itemModal').appendTo('body').modal('show');
    });
    $(document).on('click', '.show-item', function() {
        const id = $(this).data('id');
        $.get(`sousfamilles/${id}`, function(data) {
            console.log(data);
            showItemDetails(data);
            $('#showModal').appendTo('body').modal('show');
        });
    });
    // Edit Handler
    $(document).on('click', '.edit-item', function() {
        const id = $(this).data('id');
        console.log(id);
        $.get(`sousfamilles/${id}`, function(data) {
            console.log(data);
            $('#error-libelle').html('');
            $('#error-image').html('');
            $('#error-famille').html('');
            $('#modalTitle').html("Modifier sous famille");
            $('#saveBtn').html("Modifier");
            $('#itemModal').appendTo('body').modal('show');
            $('#id').val(`${data.id}`);
            $('#image').val(``);
            $('#famille').val(`${data.famille_id}`);
            $('#libelle').val(`${data.libelle}`);
        });
    });

    $('#itemForm').submit(function(e) {
        e.preventDefault();
        const formElement = document.getElementById('itemForm');
        const formData = new FormData(formElement);
        const id = $('#id').val();
        const url = id ? `sousfamilles/${id}` : '/sousfamilles';
        const method = id ? 'PUT' : 'POST';
        const message = id ? 'Sous famille modifiée avec succès' : 'Sous famille crée avec succès';
        // For RESTful routes that don't support PUT directly
        if (method === 'PUT') {
            formData.append('_method', 'PUT');
        }
        $.ajax({
            url: url,
            method: 'POST', // Always use POST when sending FormData with files
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Let browser set content type
            success: function(response) {
                $('#itemModal').modal('hide');
                $('#itemsTable').DataTable().ajax.reload();
                $('#error-libelle').html('');
                $('#error-image').html('');
                $('#error-famille').html('');
                showSuccessAlert(message);
            },
            error: function(response) {
                if (response.status === 422) { // Unprocessable Entity - validation error
                    let errors = response.responseJSON.errors;
                    // For example, if you want to display errors for the 'image' field:
                    if (errors.image) {
                        $('#error-image').html(errors.image[0]);
                    }else {
                        $('#error-image').html('');
                    }
                    if (errors.libelle) {
                        $('#error-libelle').html(errors.libelle[0]);
                    }else {
                        $('#error-libelle').html('');
                    }

                    if(errors.famille_id) {
                        $('#error-famille').html(errors.famille_id[0]);
                    }
                }
            }
        });
    });
    // Delete Handler
    $(document).on('click', '.delete-item', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas annuler cette action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `sousfamilles/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _token: '{{ csrf_token() }}' // Alternative method
                    },
                    success: function(response) {
                        $('#itemsTable').DataTable().ajax.reload();

                        // Success notification (top-right)
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Supprimé avec succès!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Erreur!',
                            'Une erreur s\'est produite lors de la suppression.',
                            'error'
                        )
                    }
                });
            }
        });
    });

    // $(document).ready(function() {
    //     const table = $('#itemsTable').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: "{{ route('familles.data') }}",
    //         columns: [{
    //                 data: 'id',
    //                 visible: false
    //             },
    //             {
    //                 data: 'libelle',
    //             },
    //             {
    //                 data: 'image',
    //             },
    //             {
    //                 data: 'created_at',
    //             },
    //             {
    //                 data: 'action',
    //                 orderable: false,
    //                 searchable: false
    //             }
    //         ],
    //         order: [
    //             [0, 'desc']
    //         ],
    //         // French language configuration
    //         language: {
    //             url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Load French translations
    //         },

    //         // Optional: Style the dropdown and pagination
    //         dom: 'lftip' // Layout control (l = length menu, f = filter, t = table, i = info, p = pagination)
    //     });
    // });

    $(document).ready(function() {
        $('#itemsTable').DataTable({
            "serverSide": true, // If using server-side processing
            "ajax": "{{ route('sousfamilles.data') }}", // Your data endpoint

            "columns": [{
                    "data": "id",
                    "visible": false
                },
                {
                    "data": "libelle"
                },
                {
                    "data": "image",
                    "render": function(data) {
                        return data ?
                            `<img src="storage/${data}" class="img-thumbnail" style="max-width: 80px; height: auto;">` :
                            'No Image';
                    },
                    "orderable": false,
                    "searchable": false
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "action",

                    "orderable": false,
                    "searchable": false
                }
            ],
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "language": {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Load French translations
            }
        });
    });
</script>
