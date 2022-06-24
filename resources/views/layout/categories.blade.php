@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-center">Categories</h3>
                <table class="table table-info table-bordered border-dark text-center">
                    <tr>
                        <th>Name</th>
                        <th>Group</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->group }}</td>
                            <td>
                                <button @if($loop->index == 0 || $loop->index == 1) disabled @endif type="button" class="btn btn-primary button-update" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-group="{{ $category->group }}" data-bs-toggle="modal" data-bs-target="#categoryUpdate">Update</button>
                            </td>
                            <td>
                                <button @if($loop->index == 0 || $loop->index == 1) disabled @endif type="button" class="btn btn-primary button-delete" data-category-id="{{ $category->id }}" data-category-group="{{ $category->group }}" data-bs-toggle="modal" data-bs-target="#categoryDelete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div> {{-- col-12 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}

    @include('modal.update_category_modal')
    @include('modal.delete_category_modal')
@endsection