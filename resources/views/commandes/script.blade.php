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
    function showLargeErrorAlert(message) {
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: message,
        width: '600px',
        confirmButtonText: 'OK',
        allowOutsideClick: false
    });
}
function showErrorAlert(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        animation: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
}


    // Create/Edit Modal Handler
    $('#createNewItem').click(function() {
        $('#error-libelle').html('');
        $('#error-image').html('');
        $('#id').val('');
        $('#itemForm').trigger("reset");
        $('#modalTitle').html("Ajouter nouvelle commande");
        $('#saveBtn').html("Ajouter");
        // $('#itemModal').modal('show');
        $('#itemModal').appendTo('body').modal('show');
    });
    $(document).on('click', '.show-item', function() {
        const id = $(this).data('id');
        $.get(`familles/${id}`, function(data) {
            console.log(data);
            showItemDetails(data);
            $('#showModal').appendTo('body').modal('show');
        });
    });
    // Edit Handler
    $(document).on('click', '.edit-item', function() {
        const id = $(this).data('id');
        $.get(`commandes/${id}`, function(data) {
            console.log(data);
            $('#error-libelle').html('');
            $('#error-image').html('');
            $('#modalTitle').html("Modifier famille");
            $('#saveBtn').html("Modifier");
            $('#itemModal').appendTo('body').modal('show');
            $('#id').val(`${data.id}`);
            $('#etat_id').val(`${data.etat_id}`);
            $('#regler').val(`${data.regle ? 'regler' : 'non_regler'}`);
            $('#paymentMode').val(`${data.mode_reglement_id}`);
            $('#clientSelect').val(`${data.user_id}`);
            $('#date').val(`${data.date}`);


        });

        $.get(`/commandes/products/${id}`, function(data) {


            console.log(data);
            // Append the new row to the products table body
            data.forEach(function(product) {
                const newRow = `
            <tr class="productRow">
                <td>
                <select value="${product.produit_id}" class="form-select productSelect" onchange="changeProduct(event)">
                    <option value="">-- Choisissez un produit --</option>
                    @foreach (App\Models\Produit::all() as $produit)
                    <option value="{{ $produit->id }}" ${product.produit_id == {{ $produit->id }} ? 'selected' : ''}>{{ $produit->designation }}</option>
                    @endforeach
                </select>
                </td>
                <td>
                <input type="text" value="${product.prix_ht}"  class="form-control priceInput" placeholder="Price">
                </td>
                <td>
                <input type="number" value="${product.quantite}"  class="form-control quantityInput" placeholder="Quantity" min="1" value="1">
                </td>
                <td>
                <input type="number" class="form-control rowTotalInput" placeholder="Row Total" readonly value="0">
                </td>
                <td class="text-center">
                <button type="button" class="removeProduct btn btn-danger">Remove</button>
                </td>
            </tr>
            `;
                $('#productsTableBody').append(newRow);
                updateProductIndices();
                recalcAll();
            });
        })
    });


    $('#paymentForm').submit(function(e) {
        e.preventDefault();
        const formElement = document.getElementById('paymentForm');
        const formData = new FormData(formElement);
        const id = $('#id').val();
        const url = id ? `commandes/${id}` : '/commandes';
        const method = id ? 'PUT' : 'POST';
        const message = id ? 'Commande modifiée avec succès' : 'Commande crée avec succès';
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
                showSuccessAlert(message);
            },
            error: function(response) {
                if (response.status === 422) { // Unprocessable Entity - validation error

                    showErrorAlert('Une erreur s\'est produite lors de la validation du formulaire. Veuillez vérifier et réessayer.');
                    let errors = response.responseJSON.errors;
                  
                    //     // Exemple de gestion des erreurs après soumission du formulaire
                    //     if (errors.paymentMode) {
                    //         $('#error-paymentMode').html(errors.paymentMode[0]);
                    //     } else {
                    //         $('#error-paymentMode').html('');
                    //     }

                    // if (errors.client) {
                    //     $('#error-client').html(errors.client[0]);
                    // } else {
                    //     $('#error-client').html('');
                    // }

                    // if (errors.nameclient) {
                    //     $('#error-nameclient').html(errors.nameclient[0]);
                    // } else {
                    //     $('#error-nameclient').html('');
                    // }

                    // if (errors.emailclient) {
                    //     $('#error-emailclient').html(errors.emailclient[0]);
                    // } else {
                    //     $('#error-emailclient').html('');
                    // }

                    // if (errors.passwordclient) {
                    //     $('#error-passwordclient').html(errors.passwordclient[0]);
                    // } else {
                    //     $('#error-passwordclient').html('');
                    // }

                    // if (errors.date) {
                    //     $('#error-date').html(errors.date[0]);
                    // } else {
                    //     $('#error-date').html('');
                    // }

                    // if (errors.etat_id) {
                    //     $('#error-etat_id').html(errors.etat_id[0]);
                    // } else {
                    //     $('#error-etat_id').html('');
                    // }

                    // if (errors.regler) {
                    //     $('#error-regler').html(errors.regler[0]);
                    // } else {
                    //     $('#error-regler').html('');
                    // }

                    // // Gestion des erreurs pour les articles (products)
                    // // Si vous avez un conteneur général pour les erreurs sur les produits
                    // if (errors.products) {
                    //     $('#error-products').html(errors.products[0]);
                    // } else {
                    //     $('#error-products').html('');
                    // }

                    // // Par ailleurs, pour gérer les erreurs individuelles de chaque article, 
                    // // on peut parcourir l'objet errors et cibler les erreurs commençant par "products."
                    // $.each(errors, function(key, messages) {
                    //     if (key.startsWith('products.')) {
                    //         // Transformation de la clé pour construire l'ID de l'élément d'erreur.
                    //         // Exemple : "products.0.product_id" devient "#error-products-0-product_id"
                    //         var errorId = '#error-' + key.replace(/\./g, '-');
                    //         $(errorId).html(messages[0]);
                    //     }
                    // });

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
                    url: `commandes/${id}`,
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
            "ajax": "{{ route('commandes.data') }}", // Your data endpoint

            "columns": [{
                    "data": "id",
                    "visible": false
                },
                {
                    "data": "date"
                },
                {
                    "data": "client",
                    "orderable": false,
                    "searchable": false
                },
                {
                    "data": "mode_reglement",
                },
                {
                    "data": "statut",
                },
                {
                    "data": "regle",
                },
                {
                    "data": "total",
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


    $('#addClientButton').click(function() {
        console.log('click');
        $(this).text($(this).text() == '+ Nouveau' ? 'Selectionner un client' : '+ Nouveau');
    });
</script>
<script>
    (function() {
        'use strict';

        const TAX_RATE = 0.20; // 20% TVA

        /**
         * Updates the indices of product input names based on their order.
         */
        window.updateProductIndices = function() {
            const productRows = document.querySelectorAll('#productsTableBody .productRow');
            productRows.forEach((row, index) => {
                const productSelect = row.querySelector('.productSelect');
                const priceInput = row.querySelector('.priceInput');
                const quantityInput = row.querySelector('.quantityInput');
                const rowTotalInput = row.querySelector('.rowTotalInput');
                if (productSelect) {
                    productSelect.name = `product[${index}][product_id]`;
                }
                if (priceInput) {
                    priceInput.name = `product[${index}][price]`;
                }
                if (quantityInput) {
                    quantityInput.name = `product[${index}][quantity]`;
                }
                if (rowTotalInput) {
                    rowTotalInput.name = `product[${index}][row_total]`;
                }
            });
        }

        /**
         * Recalculates the row total for a given row.
         * @param {HTMLElement} row - The product row element.
         */
        window.recalcRow = function(row) {
            const price = parseFloat(row.querySelector('.priceInput').value) || 0;
            const quantity = parseFloat(row.querySelector('.quantityInput').value) || 0;
            const rowTotal = price * quantity;
            row.querySelector('.rowTotalInput').value = rowTotal.toFixed(2);
            return rowTotal;
        }

        /**
         * Recalculates the totals in the table footer.
         */
        window.recalcAll = function() {
            let totalHT = 0;
            const productRows = document.querySelectorAll('#productsTableBody .productRow');
            productRows.forEach(row => {
                totalHT += recalcRow(row);
            });
            const totalTVA = totalHT * TAX_RATE;
            const totalTTC = totalHT + totalTVA;
            document.getElementById('totalHT').value = totalHT.toFixed(2);
            document.getElementById('totalTVA').value = totalTVA.toFixed(2);
            document.getElementById('totalTTC').value = totalTTC.toFixed(2);
        }

        /**
         * Adds a new product row with a fade-in effect.
         */
        var products = @json(App\Models\Produit::all());

        function addProductRow() {
            const tableBody = document.getElementById('productsTableBody');
            const newRow = document.createElement('tr');
            newRow.classList.add('productRow', 'fade-in');
            newRow.innerHTML = `
          <td>
            <select class="form-select productSelect" onchange="changeProduct(event)">
              <option value="">-- Choisissez un produit --</option>
              @foreach (App\Models\Produit::all() as $produit)
              <option value="{{ $produit->id }}">{{ $produit->designation }}</option>
              @endforeach
            </select>
          </td>
          <td>
            <input type="text" class="form-control priceInput"  placeholder="Price" >
          </td>
          <td>
            <input type="number" class="form-control quantityInput" placeholder="Quantity" min="1" value="1">
          </td>
          <td>
            <input type="number" class="form-control rowTotalInput" placeholder="Row Total" readonly value="0">
          </td>
          <td class="text-center">
            <button type="button" class="removeProduct btn btn-danger">Remove</button>
          </td>
        `;
            tableBody.appendChild(newRow);
            updateProductIndices();
            recalcAll();
        }

        /**
         * Removes a product row with a fade-out effect.
         * @param {HTMLElement} row - The row element to remove.
         */
        function removeProductRow(row) {
            row.classList.add('fade-out');
            setTimeout(() => {
                row.remove();
                updateProductIndices();
                recalcAll();
            }, 500);
        }

        // Event listener for adding product rows
        document.getElementById('addProductButton').addEventListener('click', addProductRow);



        // Event delegation for removing product rows
        document.getElementById('productsTableBody').addEventListener('click', (e) => {
            if (e.target && e.target.classList.contains('removeProduct')) {
                const row = e.target.closest('.productRow');
                removeProductRow(row);
            }
        });

        // Listen for changes in price and quantity inputs using event delegation
        document.getElementById('productsTableBody').addEventListener('input', (e) => {
            if (e.target && (e.target.classList.contains('priceInput') || e.target.classList.contains(
                    'quantityInput'))) {
                recalcAll();
            }
        });



        // Event for change product
        window.changeProduct = function(event) {
            const selectedProduct = event.target.value;
            const product = products.find(product => product.id == selectedProduct);
            if (product) {
                event.target.closest('.productRow').querySelector('.priceInput').value = product.prix_ht;
                event.target.closest('.productRow').querySelector('.quantityInput').value = 1;
                recalcAll();
            }
        }

        // Event listener for saving a new client inline
        // document.getElementById('saveClientButton').addEventListener('click', () => {
        //   const newClientName = document.getElementById('newClientName').value.trim();
        //   if (newClientName) {
        //     const clientSelect = document.getElementById('clientSelect');
        //     const newOption = document.createElement('option');
        //     newOption.value = newClientName;
        //     newOption.text = newClientName;
        //     clientSelect.appendChild(newOption);
        //     clientSelect.value = newClientName;
        //     document.getElementById('newClientName').value = '';
        //     // Collapse the inline client form
        //     const collapseElement = document.getElementById('clientCollapse');
        //     const bsCollapse = bootstrap.Collapse.getInstance(collapseElement) || new bootstrap.Collapse(collapseElement, {toggle: false});
        //     bsCollapse.hide();
        //   } else {
        //     alert('Please enter a client name.');
        //   }
        // });

        // Optional form submission handler (customize as needed)
        // document.getElementById('paymentForm').addEventListener('submit', (e) => {
        //   e.preventDefault();
        //   // TODO: Process form data here
        //   alert('Form submitted!');
        // });

        // Initial recalculation
        recalcAll();
    })();
</script>
