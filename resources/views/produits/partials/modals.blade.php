<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
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
                    <input type="hidden" name="id" id="id">



                    <span for='codebar'>Codebar</span>
                    <input type="text" id="codebar" name="codebar" class="form-control" placeholder="Codebar">
                    <p id="error-codebar" class="text-danger"></p>

                    <span for='prix_ht'>Prix HT</span>
                    <input type="text" id="prix_ht" name="prix_ht" class="form-control" placeholder="Prix HT">
                    <p id="error-prix_ht" class="text-danger"></p>

                    <span for='tva'>TVA</span>
                    <input type="text" id="tva" name="tva" class="form-control" placeholder="TVA">
                    <p id="error-tva" class="text-danger"></p>

                    <span for='description'>Description</span>
                    <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                    <p id="error-description" class="text-danger"></p>

                    <span for='image'>Image</span>
                    <input type="file" id="image" name="image" class="form-control mt-2" placeholder="Image">
                    <p id="error-image" class="text-danger"></p>

                    <span for='sous_famille'>Sous Famille</span>
                    <select id="sous_famille" name="sous_famille" class="form-control">
                        <!-- Options should be populated dynamically -->
                    </select>
                    <p id="error-sous_famille" class="text-danger"></p>

                    <span for='marque'>Marque</span>
                    <select id="marque" name="marque" class="form-control">
                        <!-- Options should be populated dynamically -->
                    </select>
                    <p id="error-marque" class="text-danger"></p>

                    <span for='unite'>Unite</span>
                    <select id="unite" name="unite" class="form-control">
                        <!-- Options should be populated dynamically -->
                    </select>
                    <p id="error-unite" class="text-danger"></p>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Afficher Famille</h5>
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <!-- Display Libelle -->
                <div class="mb-3">
                    <label class="form-label">Libelle</label>
                    <p id="showLibelle" class="form-control-plaintext"></p>
                </div>
                <!-- Display Image -->
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <div id="showImage">
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
