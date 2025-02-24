<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog large-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Ajouter nouvelle famille</h5>
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>
            <form id="itemForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6 mb-3">
                            <span for='codebar'>Codebar</span>
                            <input type="text" id="codebar" name="codebar" class="form-control" placeholder="Codebar">
                            <p id="error-codebar" class="text-danger"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span for='prix_ht'>Prix HT</span>
                            <input type="text" id="prix_ht" name="prix_ht" class="form-control" placeholder="Prix HT">
                            <p id="error-prix_ht" class="text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span for='tva'>TVA</span>
                            <input type="text" id="tva" name="tva" class="form-control" placeholder="TVA">
                            <p id="error-tva" class="text-danger"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span for='description'>Description</span>
                            <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                            <p id="error-description" class="text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span for='designation'>Designation</span>
                            <input type="text" id="designation" name="designation" class="form-control" placeholder="Designation"></>
                            <p id="error-designation" class="text-danger"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span for='image'>Image</span>
                            <input type="file" id="image" name="image" class="form-control mt-2" placeholder="Image">
                            <p id="error-image" class="text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span for='sous_famille'>Sous Famille</span>
                            <select id="sous_famille" name="sous_famille" class="form-control">
                                @foreach ( App\Models\SousFamille::all() as $sous_famille)
                                    <option value="{{ $sous_famille->id }}">{{ $sous_famille->libelle }}</option>
                                @endforeach
                            </select>
                            <p id="error-sous_famille" class="text-danger"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span for='marque'>Marque</span>
                            <select id="marque" name="marque" class="form-control">
                                @foreach ( App\Models\Marque::all() as $marque)
                                    <option value="{{ $marque->id }}">{{ $marque->marque }}</option>
                                @endforeach
                            </select>
                            <p id="error-marque" class="text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span for='unite'>Unite</span>
                            <select id="unite" name="unite" class="form-control">
                                @foreach ( App\Models\Unite::all() as $unite)
                                    <option value="{{ $unite->id }}">{{ $unite->unite }}</option>
                                @endforeach
                            </select>
                            <p id="error-unite" class="text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveItem" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Afficher Famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Display Codebar -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Codebar</label>
                        <p id="showCodebar" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                    <!-- Display Prix HT -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Prix HT</label>
                        <p id="showPrixHt" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                </div>
                <div class="row">
                    <!-- Display TVA -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">TVA</label>
                        <p id="showTva" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                    <!-- Display Description -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p id="showDescription" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                </div>
                <div class="row">
                    <!-- Display Designation -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Designation</label>
                        <p id="showDesignation" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                    <!-- Display Image -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Image</label>
                        <div id="showImage" class="border rounded p-2">
                            <img src="" alt="Image" class="img-fluid custom-large-image">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Display Sous Famille -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sous Famille</label>
                        <p id="showSousFamille" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                    <!-- Display Marque -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Marque</label>
                        <p id="showMarque" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                </div>
                <div class="row">
                    <!-- Display Unite -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Unite</label>
                        <p id="showUnite" class="form-control-plaintext border rounded p-2"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
