@extends('layouts.app')

@section('content')
    <div class="section-body">
        <div class="mb-3">
            <button class="btn btn-primary" id="createNewItem">
                <i class="fas fa-plus"></i> Ajouter
            </button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Produit liste</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="itemsTable" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th hidden>#</th>
                                        <th>CodeBar</th>
                                        <th>Designation</th>
                                        <th>Prix HT</th>
                                        <th>Tva</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTables will populate this -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('produits.partials.modals')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('produits.script')
@endsection
