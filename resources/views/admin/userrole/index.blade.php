@extends('admin.layouts.main')


@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="success-message" data-successmessage="{{ session('success') }}"></div>

        <div class="card-body">
            <div class="py-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#storeModal">
                    Add Role
                  </button>
            </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->role }}</td>
                                    <td>
                                        <a href="/admin/configuration/useraccessmenu/{{ $r->id }}" class="btn btn-sm btn-primary">Access</a>
                                        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}">
                                        Edit
                                      </button>
                                      <a class="btn btn-sm btn-danger button-delete" href="/admin/configuration/userrole/delete/{{ $r->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Store --}}
<div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="storeModalLabel">Add Roles</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/configuration/userrole/store" method="post">
                @csrf
                <div class="row mb-3">
                    <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>
                    <div class="col-md-6">
                        <input id="role" type="text" class="form-control" name="role" required autocomplete="role" autofocus>
                    </div>
                </div>
        </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
</div>
</div>
{{-- End Modal Store --}}

{{-- Modal Edit --}}
@foreach ($role as $r)
<div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1" aria-labelledby="editModal{{ $r->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal{{ $r->id }}Label">Update Roles</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/configuration/userrole/update" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $r->id }}">
                <div class="row mb-3">
                    <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>
                    <div class="col-md-6">
                        <input id="role" type="text" class="form-control" name="role" value="{{ $r->role }}" required autocomplete="role" autofocus>
                    </div>
                </div>
        </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- End Modal Edit --}}

@endsection

@section('js')

<script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endsection
