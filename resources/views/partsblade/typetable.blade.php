@extends('layout.main')

<!-- Sidebar -->
@include('include.sidebar')

@section('content')
<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Part Type</h5>
        
        <!-- Message Inclusion -->
        <div class="mb-3">
            @include('include.message')
        </div>

        <!-- Add Type Button -->
        <div class="mb-3">
            <a href="/partstable" class="btn btn-secondary ms-2">Back</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTypeModal">
                ADD TYPE
            </button>
        </div>

        <!-- Responsive and hover table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Part Type Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($partstypes as $partstype)
                    <tr>
                        <td>{{ $partstype->part_type }}</td>
                        <td>
                            <div class="btn-group">
                                <!-- Edit Button triggers the modal with dynamic ID -->
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editTypeModal-{{ $partstype->parts_type_id }}">Edit</button>
                                <!-- Delete Button triggers the delete modal -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTypeModal-{{ $partstype->parts_type_id }}">Delete</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Type Modal for each partstype -->
                    <div class="modal fade" id="editTypeModal-{{ $partstype->parts_type_id }}" tabindex="-1" aria-labelledby="editTypeModalLabel-{{ $partstype->parts_type_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('partstype.update', ['id' => $partstype->parts_type_id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editTypeModalLabel-{{ $partstype->parts_type_id }}">Edit Part Type</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="partType-{{ $partstype->parts_type_id }}" class="form-label">Part Type Name</label>
                                            <input type="text" class="form-control" id="partType-{{ $partstype->parts_type_id }}" name="part_type" value="{{ $partstype->part_type }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Type Modal for each partstype -->
                    <div class="modal fade" id="deleteTypeModal-{{ $partstype->parts_type_id }}" tabindex="-1" aria-labelledby="deleteTypeModalLabel-{{ $partstype->parts_type_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteTypeModalLabel-{{ $partstype->parts_type_id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this Part Type?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('partstype.destroy', ['id' => $partstype->parts_type_id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Type Modal -->
<div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/addpartsType" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTypeModalLabel">Add New Part Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="partType" class="form-label">Part Type Name</label>
                        <input type="text" class="form-control" id="partType" name="part_type">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
