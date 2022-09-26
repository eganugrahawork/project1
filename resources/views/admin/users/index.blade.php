@extends('admin.layouts.main')


@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="success-message" data-successmessage="{{ session('success') }}"></div>

        <div class="card-body">
            @if (auth()->user()->id_role == 1)
            <div class="py-2">
                <a class="btn btn-sm btn-primary" href="/admin/users/create">
                    Add User
                </a>
                        <a class="btn btn-sm btn-success" href="/admin/configuration/menu">
                            Menues Page
                        </a>
                    </div>
                    @endif
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Region</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $usr)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'. $usr->userdetail->image) }}" alt="" style="width:50px; height:50px; display:block; margin-left:auto; margin-right:auto;" >
                                    </td>
                                    <td class="align-middle">{{ $usr->userdetail->nama }}</td>
                                    <td class="align-middle">{{ $usr->username }}</td>
                                    <td class="align-middle">
                                            {{ $usr->userrole->role }}
                                            @if (auth()->user()->userrole->role === 'Super Admin')
                                                <a class="btn btn-sm btn-outline-warning" href="/admin/configuration/useraccessmenu/{{ $usr->id_role }}"><span data-feather="edit"></span></a>
                                            @endif
                                    </td>
                                    <td class="align-middle">{{ $usr->userdetail->lokasi }}</td>
                                    <td class="align-middle"></td>
                                    <td class="align-middle">
                                        <a href="/admin/users/show/{{ $usr->id }}" class="btn btn-sm btn-primary">View</a>
                                        @if (auth()->user()->id_role == 1)
                                        <a class="btn btn-sm btn-warning text-white" href="/admin/users/edit/{{ $usr->id }}">
                                        Edit
                                        </a>
                                        <a class="btn btn-sm btn-danger button-delete" href="/admin/users/delete/{{ $usr->id }}">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endsection
