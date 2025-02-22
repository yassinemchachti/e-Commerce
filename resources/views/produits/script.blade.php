<script>
    // Example: Setting values before showing the modal
    function showItemDetails(item) {
        console.log('showItemDetails',item);
        document.querySelector('#showImage img').src = `storage/${item.image}`;
        $('#id').val(`${item.id}`);
        $('#showDesignation').html(`${item.designation}`);
        $('#showCodebar').html(`${item.code_barre}`);
        $('#showPrixHt').html(`${item.prix_ht}`);
        $('#showTva').html(`${item.tva}`);
        $('#showDescription').html(`${item.description}`);
        $('#showSousFamille').html(`${item.sous_famille_id}`);
        $('#showMarque').html(`${item.marque_id}`);
        $('#showUnite').html(`${item.unite_id}`);
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
        $('#error-libelle').html('');
        $('#error-image').html('');
        $('#id').val('');
        $('#itemForm').trigger("reset");
        $('#modalTitle').html("Ajouter nouvelle produit");
        $('#saveBtn').html("Ajouter");
        // $('#itemModal').modal('show');
        $('#itemModal').appendTo('body').modal('show');
    });
    $(document).on('click', '.show-item', function() {
        const id = $(this).data('id');
        $.get(`produits/${id}`, function(data) {
            console.log(data);
            showItemDetails(data);
            $('#showModal').appendTo('body').modal('show');
        });
    });
    // Edit Handler
    $(document).on('click', '.edit-item', function() {
        const id = $(this).data('id');
        $.get(`produits/${id}`, function(data) {
            console.log(data);
            $('#error-codebar').html('');
            $('#error-image').html('');
            $('#error-prix_ht').html('');
            $('#error-tva').html('');
            $('#error-description').html('');
            $('#error-sous_famille').html('');
            $('#error-marque').html('');
            $('#error-unite').html('');
            $('#error-designation').html('');
            $('#modalTitle').html("Modifier produit");
            $('#saveBtn').html("Modifier");
            $('#itemModal').appendTo('body').modal('show');
            $('#id').val(`${data.id}`);
            $('#image').val(``);
            $('#codebar').val(`${data.code_barre}`);
            $('#image').val(``);
            $('#prix_ht').val(`${data.prix_ht}`);
            $('#tva').val(`${data.tva}`);
            $('#description').val(`${data.description}`);
            $('#sous_famille').val(`${data.sous_famille_id}`);
            $('#marque').val(`${data.marque_id}`);
            $('#unite').val(`${data.unite_id}`);
        });
    });

    $('#itemForm').submit(function(e) {
        e.preventDefault();
        const formElement = document.getElementById('itemForm');
        const formData = new FormData(formElement);
        const id = $('#id').val();
        const url = id ? `produits/${id}` : '/produits';
        const method = id ? 'PUT' : 'POST';
        const message = id ? 'Produit modifiée avec succès' : 'Produit crée avec succès';
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
                $('#error-codebar').html('');
                $('#error-image').html('');
                $('#error-prix_ht').html('');
                $('#error-tva').html('');
                $('#error-description').html('');
                $('#error-sous_famille').html('');
                $('#error-marque').html('');
                $('#error-unite').html('');
                $('#error-designation').html('');
                showSuccessAlert(message);
            },
            error: function(response) {
                if (response.status === 422) { // Unprocessable Entity - validation error
                    let errors = response.responseJSON.errors;
                    // For example, if you want to display errors for the 'image' field:
                    if (errors.image) {
                        $('#error-image').html(errors.image[0]);
                    } else {
                        $('#error-image').html('');
                    }
                    if (errors.codebar) {
                        $('#error-codebar').html(errors.codebar[0]);
                    } else {
                        $('#error-codebar').html('');
                    }
                    if (errors.prix_ht) {
                        $('#error-prix_ht').html(errors.prix_ht[0]);
                    } else {
                        $('#error-prix_ht').html('');
                    }
                    if (errors.tva) {
                        $('#error-tva').html(errors.tva[0]);
                    } else {
                        $('#error-tva').html('');
                    }
                    if (errors.description) {
                        $('#error-description').html(errors.description[0]);
                    } else {
                        $('#error-description').html('');
                    }
                    if (errors.sous_famille) {
                        $('#error-sous_famille').html(errors.sous_famille[0]);
                    } else {
                        $('#error-sous_famille').html('');
                    }
                    if (errors.marque) {
                        $('#error-marque').html(errors.marque[0]);
                    } else {
                        $('#error-marque').html('');
                    }
                    if (errors.unite) {
                        $('#error-unite').html(errors.unite[0]);
                    } else {
                        $('#error-unite').html('');
                    }
                    if (errors.designation) {
                        $('#error-designation').html(errors.designation[0]);
                    } else {
                        $('#error-designation').html('');
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
                    url: `produits/${id}`,
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
    $(document).ready(function() {
    $('#itemsTable').DataTable({
      serverSide: true,
      ajax: "{{ route('produits.data') }}",
      columns: [
        { data: 'id', visible: false },
        { data: 'code_barre' },
        { data: 'designation' },
        { data: 'prix_ht' },
        { data: 'tva' },
        { data: 'action', orderable: false, searchable: false }
      ],
      order: [[0, 'desc']],
      // Set default number of rows per page
      pageLength: 10,
      // Define available options for rows per page
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tout"]],
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
      }
    });
  });
</script>
