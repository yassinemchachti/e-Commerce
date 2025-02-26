<style>
    body {
        background: #f7f7f7;
        font-family: Arial, sans-serif;
    }

    /* Modal customization */
    .modal-content {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: #007bff;
        color: #fff;
        border-bottom: none;
        padding: 1.5rem 1.5rem;
    }

    .modal-header .btn {
        color: #fff;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: none;
        padding: 1rem 2rem;
    }

    /* Card styling within modals */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .card-header {
        background: #007bff;
        color: #fff;
        font-size: 1.25rem;
        padding: 0.75rem 1.25rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Form element enhancements */
    .form-select,
    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        background: #007bff;
        border: none;
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
    }

    .btn-success {
        background: #28a745;
        border: none;
    }
</style>

<!-- Item Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter Nouvelle Commande</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">Commande</div>
                    <div class="card-body">
                        <form id="paymentForm">
                            <!-- Payment Mode Section -->
                            <div class="mb-3 row">
                                <label for="paymentMode" class="col-sm-3 col-form-label">Mode de Règlement:</label>
                                <div class="col-sm-9">
                                    <select id="paymentMode" name="paymentMode" class="form-select">
                                        @foreach (App\Models\ModeReglement::all() as  $regelement)
                                        <option value="{{$regelement->id}}">{{$regelement->mode_reglement}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Client Section with Inline Client Add Form -->
                            <div class="mb-3 row">
                                <label for="clientSelect" class="col-sm-3 col-form-label">Client:</label>
                                <div class="col-sm-7">
                                    <select id="clientSelect" name="client" class="form-select">
                                        <option value="">--Select Client--</option>
                                        <option value="client1">Client 1</option>
                                        <option value="client2">Client 2</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse"
                                        data-bs-target="#clientCollapse" aria-expanded="false"
                                        aria-controls="clientCollapse">
                                        Add Client
                                    </button>
                                </div>
                            </div>
                            <!-- Inline collapsible client add form -->
                            <div class="collapse mb-3" id="clientCollapse">
                                <div class="card card-body">
                                    <div class="mb-3">
                                        <input type="text" id="newClientName" class="form-control"
                                            placeholder="Enter client name" aria-label="Client Name">
                                    </div>
                                    <button type="button" id="saveClientButton" class="btn btn-primary">Save
                                        Client</button>
                                </div>
                            </div>
                            <!-- Date Fields -->
                            <div class="mb-3 row">
                                <label for="date" class="col-sm-3 col-form-label">Date:</label>
                                <div class="col-sm-9">
                                    <input type="date" id="date" name="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="paymentDate" class="col-sm-3 col-form-label">Date Règlement:</label>
                                <div class="col-sm-9">
                                    <input type="date" id="paymentDate" name="paymentDate" class="form-control"
                                        required>
                                </div>
                            </div>
                            <!-- Products Table -->
                            <h4 class="mt-4">Products</h4>
                            <table class="table table-bordered" id="productsTable">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price (HT)</th>
                                        <th>Quantity</th>
                                        <th>Total (HT)</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    <!-- Product rows will be dynamically added here -->
                                </tbody>
                                <!-- Footer with Totals -->
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-end">
                                            <div class="d-flex justify-content-end align-items-center">
                                                <div class="me-3">
                                                    <label class="totals-label">Total HT:</label>
                                                    <input type="number" id="totalHT"
                                                        class="form-control totals-input" readonly value="0">
                                                </div>
                                                <div class="me-3">
                                                    <label class="totals-label">TVA (20%):</label>
                                                    <input type="number" id="totalTVA"
                                                        class="form-control totals-input" readonly value="0">
                                                </div>
                                                <div>
                                                    <label class="totals-label">Total TTC:</label>
                                                    <input type="number" id="totalTTC"
                                                        class="form-control totals-input" readonly value="0">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="mb-3">
                                <button type="button" id="addProductButton" class="btn btn-secondary">Add
                                    Product</button>
                            </div>
                            <div class="modal-footer p-0">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="saveItem" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Afficher Famille</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display Libelle -->
                    <div class="mb-4">
                        <label class="form-label">Libelle</label>
                        <p id="showLibelle" class="form-control-plaintext"></p>
                    </div>
                    <!-- Display Image -->
                    <div class="mb-4">
                        <label class="form-label">Image</label>
                        <div id="showImage" class="text-center">
                            <img src="" alt="Image" class="img-fluid custom-large-image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
