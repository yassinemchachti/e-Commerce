<script>
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
        $('#modalTitle').html("Ajouter nouvelle Etat");
        $('#saveBtn').html("Ajouter");
        $('#itemModal').appendTo('body').modal('show');
    });
    // Edit Handler
    $(document).on('click', '.edit-item', function() {
        const id = $(this).data('id');
        $.get(`mode_reglements/${id}`, function(data) {
            console.log(data);
            $('#error-mode_reglement').html('');
            $('#modalTitle').html("Modifier mode de reglement");
            $('#saveBtn').html("Modifier");
            $('#itemModal').appendTo('body').modal('show');
            $('#id').val(`${data.id}`);
            $('#mode_reglement').val(`${data.mode_reglement}`);
        });
    });

    $('#itemForm').submit(function(e) {
        e.preventDefault();
        const formElement = document.getElementById('itemForm');
        const formData = new FormData(formElement);
        const id = $('#id').val();
        const url = id ? `mode_reglements/${id}` : '/mode_reglements';
        const method = id ? 'PUT' : 'POST';
        const message = id ? 'Mode de reglement modifiée avec succès' : 'Mode de reglement crée avec succès';
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
                $('#error-mode_reglement').html('');
                showSuccessAlert(message);
            },
            error: function(response) {
                if (response.status === 422) { // Unprocessable Entity - validation error
                    let errors = response.responseJSON.errors;
                    // For example, if you want to display errors for the 'image' field:
                    if (errors.mode_reglement) {
                        $('#error-mode_reglement').html(errors.mode_reglement[0]);
                    }else {
                        $('#error-mode_reglement').html('');
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
                    url: `mode_reglements/${id}`,
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
            "ajax": "{{ route('mode_reglements.data') }}", // Your data endpoint

            "columns": [{
                    "data": "id",
                    "visible": false
                },
                {
                    "data": "mode_reglement"
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
