@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <style>
        .costum-card{
            min-height: 250px;
            width: 180px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            background: #fff;
            color: black;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
            transition: 0.2s;
            padding: 25%;
        }
        .costum-card:hover{
            box-shadow: none;
        }
        .list-view{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            gap: 12px;
        }
    </style>

    <div class="container mt-4">
        <div class="list-view">
            <div id="openModalCard" data-toggle="modal" data-target="#folderFormModal">
                <div class="costum-card fs-5">
                    ➕
                </div>
            </div>
        </div>
    </div>

    <!-- Folder Modal -->
    <div class="modal fade" id="folderFormModal" tabindex="-1" role="dialog" aria-labelledby="folderFormModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" id="folderForm">
                @csrf
                <input type="hidden" class="folder-id" name="folder-id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control text-capitalize" id="name" name="name">
                        <span class="invalid-feedback nameError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notes Modal -->
    <div class="modal fade" id="noteFormModal" tabindex="-1" role="dialog" aria-labelledby="noteFormModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" id="noteForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control text-capitalize" id="name" name="name">
                        <span class="invalid-feedback nameError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('/js/app.js') }}"></script>
@endsection
