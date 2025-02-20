<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Ajouter nouvelle Etat</h5>
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form id="itemForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <span for='mode_reglement'>Mode Regelement</span>
                    <input type="text" id="mode_reglement" name="mode_reglement" class="form-control" placeholder="Mode Regelement">
                        <p id="error-mode_reglement"  class="text-danger"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveItem" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

