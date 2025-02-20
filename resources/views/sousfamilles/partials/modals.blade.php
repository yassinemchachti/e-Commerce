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
                    <span for='famille'>Libelle</span>
                    <select name="famille_id" id="famille" class="form-control">
                        @foreach ( App\Models\Famille::all() as $famille)
                            <option value="{{ $famille->id }}">{{ $famille->libelle }}</option>
                        @endforeach
                    </select>
                    <p id="error-famille" class="text-danger"></p>
                    <input type="hidden" name="id" id="id">
                    <span for='libelle'>Libelle</span>
                    <input type="text" id="libelle" name="libelle" class="form-control" placeholder="Libelle">
                        <p id="error-libelle"  class="text-danger"></p>
                    <span for='image'>Image</span>
                    <input type="file" id="image" name="image" class="form-control mt-2" placeholder="Image">
                        <p id="error-image" class="text-danger"></p>
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
                <h5 class="modal-title" id="modalTitleshow">Afficher Sous Famille</h5>
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
