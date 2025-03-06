<!-- Item Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-light border-bottom">
                <h5 class="modal-title text-dark fs-5 fw-600">Nouvelle Commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="paymentForm" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-4 mb-4">
                        <input type="text" id="id" name="id" hidden>
                        <!-- Payment Mode -->
                        <div class="col-md-6">
                            <label class="form-label text-dark fs-6">Mode de Règlement</label>
                            <select id="paymentMode" name="paymentMode"
                                class="form-select form-select-sm border-secondary-20">
                                <option value="">-- Choisissez un mode de reglement --</option>
                                @foreach (App\Models\ModeReglement::all() as $regelement)
                                    <option value="{{ $regelement->id }}">{{ $regelement->mode_reglement }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Client Selection -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-end gap-2">
                                <div class="flex-grow-1" id="clientSelection">
                                    <label class="form-label text-dark fs-6">Client</label>
                                    <select id="clientSelect" name="client"
                                        class="form-select form-select-sm border-secondary-20">
                                        <option value="">-- Choisissez un client --</option>
                                        @foreach (App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button"
                                    class="btn btn-sm btn-outline-dark border-secondary-20 flex-shrink-0"
                                    id="addClientButton" data-bs-toggle="collapse" data-bs-target="#clientCollapse">+
                                    Nouveau</button>
                            </div>
                        </div>
                    </div>

                    <!-- Client Add Form -->
                    <div class="collapse mb-4" id="clientCollapse">
                        <div class="bg-light p-3 rounded-1">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" id="newClientName" name="nameclient"
                                        class="form-control form-control-sm" placeholder="Nom complet" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" id="newClientEmail" name="emailclient"
                                        class="form-control form-control-sm" placeholder="Email" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="password" id="newClientPassword" name="passwordclient"
                                        class="form-control form-control-sm" placeholder="Mot de passe" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date Fields -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-dark fs-6">Date Commande</label>
                            <input type="date" id="date" name="date"
                                class="form-control form-control-sm border-secondary-20" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-dark fs-6">État de la Commande</label>
                            <select name="etat_id" id="etat_id"
                                class="form-select form-select-sm border-secondary-20" required>
                                <option value="">-- Choisissez un état --</option>
                                @foreach (App\Models\Etat::all() as $etat)
                                    <option value="{{ $etat->id }}" {{ 'en_cours' == $etat->etat ? 'selected' : '' }}>{{ $etat->etat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-dark fs-6">Régler</label>
                            <select id="regler" name="regler" class="form-select form-select-sm border-secondary-20">
                                <option value="non_regler">Non Régler</option>
                                <option value="regler">Régler</option>
                            </select>
                        </div>
                    </div>
                 

                    <!-- Products Table -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-dark fs-6 mb-0">Articles</h6>
                            <button type="button" id="addProductButton" class="btn btn-sm btn-dark">
                                + Ajouter Article
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle" id="productsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-3">Article</th>
                                        <th>Prix HT</th>
                                        <th>Quantité</th>
                                        <th>Total HT</th>
                                        <th class="pe-3" style="width: 40px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    <!-- Dynamic content -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Totals Section -->
                    <div class="bg-light p-3 rounded-1 mb-4">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-transparent border-0">Total HT</span>
                                    <input type="number" id="totalHT" class="form-control-plaintext text-end"
                                        readonly value="0">
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-transparent border-0">TVA</span>
                                    <input type="number" id="totalTVA" class="form-control-plaintext text-end"
                                        readonly value="0">
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-transparent border-0 fw-600">Total TTC</span>
                                    <input type="number" id="totalTTC"
                                        class="form-control-plaintext text-end fw-600" readonly value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" id="saveItem" class="btn btn-sm btn-dark">
                            Enregistrer Commande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Remove all validation styles */
    .was-validated .form-control:valid,
    .was-validated .form-control:invalid,
    .form-control.is-valid,
    .form-control.is-invalid {
        border-color: #dee2e6 !important;
        background-image: none !important;
        box-shadow: none !important;
    }

    .was-validated .form-select:valid,
    .was-validated .form-select:invalid,
    .form-select.is-valid,
    .form-select.is-invalid {
        border-color: #dee2e6 !important;
        background-image: none !important;
        box-shadow: none !important;
    }

    /* Keep original styling */
    .border-secondary-20 {
        border: 1px solid #dee2e6;
    }

    .form-control-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }

    .form-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .table th {
        font-weight: 500;
        font-size: 0.875rem;
        background-color: #f8f9fa;
    }

    .table td {
        padding: 0.5rem 0.75rem;
    }

    .fw-600 {
        font-weight: 600;
    }
</style>
