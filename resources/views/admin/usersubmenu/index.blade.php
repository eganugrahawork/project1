@extends('admin.layouts.main')


@section('content')
<div class="container mt-4">
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <div class="py-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#storeModal">
                    Add Submenu
                  </button>
            </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Submenu</th>
                                <th class="text-center">Menu</th>
                                <th class="text-center">Url</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submenu as $sm)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $sm->submenu }}</td>
                                    <td>{{ $sm->usermenu->menu }}</td>
                                    <td>{{ $sm->urlsubmenu }}</td>
                                    <td>

                                            <a class="btn btn-sm btn-danger button-delete" href="/admin/configuration/submenu/delete/{{ $sm->id }}">Delete</a>
                                        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal{{ $sm->id }}">
                                            Edit
                                        </button>
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
          <h5 class="modal-title" id="storeModalLabel">Add Submenues</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/configuration/submenu/store" method="post">
                @csrf
                <div class="row mb-3">
                    <label for="submenu" class="col-md-4 col-form-label text-md-end">Submenu</label>
                <div class="col-md-6">
                    <input id="submenu" type="text" class="form-control" name="submenu" required autocomplete="submenu" autofocus>
                </div>
                </div>
                <div class="row mb-3">
                    <label for="id_menu" class="col-md-4 col-form-label text-md-end">Menu </label>
                    <div class="col-lg-6">
                        <select class="form-select form-select-sm"  name="id_menu" required>
                            @foreach ($menu as $m )
                            <option value="{{ $m->id }}">{{ $m->menu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="urlnya">
                    <label for="urlsubmenu" class="col-md-4 col-form-label text-md-end">Url Submenu</label>
                    <div class="col-md-6">
                        <input id="urlsubmenu" type="text" class="form-control" name="urlsubmenu" autocomplete="urlsubmenu" autofocus>
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

{{-- Modal update --}}
@foreach ($submenu as $sm)
<div class="modal fade" id="editModal{{ $sm->id }}" tabindex="-1" aria-labelledby="editModal{{ $sm->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal{{ $sm->id }}Label">Add Submenues</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/configuration/submenu/update" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $sm->id }}">
                <div class="row mb-3">
                    <label for="submenu" class="col-md-4 col-form-label text-md-end">Submenu</label>
                <div class="col-md-6">
                    <input id="submenu" type="text" class="form-control" name="submenu" value="{{ $sm->submenu }}" required autocomplete="submenu" autofocus>
                </div>
                </div>
                <div class="row mb-3">
                    <label for="id_menu" class="col-md-4 col-form-label text-md-end">Menu </label>
                    <div class="col-lg-6">
                        <select class="form-select form-select-sm"  name="id_menu" required>
                            @foreach ($menu as $m )
                            <option value="{{ $m->id }}" @if ($m->id == $sm->id_menu)
                                selected
                            @endif>{{ $m->menu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="urlnya">
                    <label for="urlsubmenu" class="col-md-4 col-form-label text-md-end">Url Submenu</label>
                    <div class="col-md-6">
                        <input id="urlsubmenu" type="text" class="form-control" value="{{ $sm->urlsubmenu }}" name="urlsubmenu" autocomplete="urlsubmenu" autofocus>
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
{{-- End Modal update --}}

@endsection

@section('js')

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endsection
