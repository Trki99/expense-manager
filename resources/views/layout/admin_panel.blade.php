@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-center">Users List</h3>
                <table class="table table-info table-bordered border-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <button type="button" class="btn btn-primary button-update" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-bs-toggle="modal" data-bs-target="#userUpdate">Update</button>
                        </td>
                        <td>
                            @if( isset($user->block_message) )
                                <form action="{{ route('admin_unblock_user') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" onclick="return confirmAction()" class="btn btn-primary">Unblock</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-primary button-block" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-bs-toggle="modal" data-bs-target="#userBlock">Block</button>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin_delete_user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" onclick="return confirmAction()" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div> {{-- col-12 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}

    <script>
        function confirmAction() {
            return confirm("Are you sure?");
        }
    </script>

    @include('modal.update_user_modal')
    @include('modal.block_user_modal')
@endsection