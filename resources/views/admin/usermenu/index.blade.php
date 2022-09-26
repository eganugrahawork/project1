@extends('admin.layouts.main')


@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="success-message" data-successmessage="{{ session('success') }}"></div>
        <div class="fail-message" data-failmessage="{{ session('fail') }}"></div>

        <div class="card-body">
            <div class="py-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#storeModal">
                    Add Menu
                  </button>
                  <a href="/admin/configuration/submenu" class="btn btn-sm btn-success">Submenues</a>
            </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Menu</th>
                                <th class="text-center">Icon</th>
                                <th class="text-center">Url</th>
                                <th class="text-center">Submenu</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $m)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $m->menu }} </td>
                                    <td class="text-center"><span data-feather="{{ $m->icon }}" class="align-text-bottom"></span></td>
                                    <td>{{ $m->url }}</td>
                                    <td class="text-center">
                                        @if ($m->is_submenu == true)
                                            <p class="text-success">
                                                <span data-feather="check-circle" class="align-text-bottom"></span>
                                            </p>
                                            @else
                                            <p class="text-secondary">
                                                <span data-feather="x-circle" class="align-text-bottom"></span>
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal{{ $m->id }}">
                                                Edit
                                            </button>
                                            <a class="btn btn-sm btn-danger button-delete" href="/admin/configuration/menu/delete/{{ $m->id }}">Delete</a>
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
          <h5 class="modal-title" id="storeModalLabel">Add Menues</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/configuration/menu/store" method="post">
                @csrf
                <div class="row mb-3">
                    <label for="menu" class="col-md-4 col-form-label text-md-end">Menu</label>
                <div class="col-md-6">
                    <input id="menu" type="text" class="form-control" name="menu" required autocomplete="menu" autofocus>
                </div>
                </div>
                <div class="row mb-3">
                    <label for="icon" class="col-md-4 col-form-label text-md-end">Icon</label>
                    <div class="col-md-6">
                        <input id="icon" type="text" class="form-control" name="icon" required autocomplete="icon" autofocus>
                    </div>
                </div>
                <div class="row mb-3" id="urlnya">
                    <label for="url" class="col-md-4 col-form-label text-md-end">Url</label>
                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control" name="url" autocomplete="url" autofocus>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3 form-check form-switch ">
                    <input class="form-check-input" name="is_submenu" type="checkbox" role="switch" id="is_submenu" >
                    <label class="form-check-label" for="flexSwitchCheckChecked" >Is Submenu ?</label>
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
@php
    $hit =0;
@endphp
@foreach ($menu as $m)

<div class="modal fade" id="editModal{{ $m->id }}" tabindex="-1" aria-labelledby="editModal{{ $m->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal{{ $m->id }}Label">Edit Menues</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/configuration/menu/update" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $m->id }}">
                <div class="row mb-3">
                    <label for="menu" class="col-md-4 col-form-label text-md-end">Menu</label>
                <div class="col-md-6">
                    <input id="menu" type="text" class="form-control" name="menu" value="{{ $m->menu }}" required autofocus>
                </div>
                </div>
                <div class="row mb-3">
                    <label for="icon" class="col-md-4 col-form-label text-md-end">Icon</label>
                    <div class="col-md-6">
                        <input id="icon" type="text" class="form-control" name="icon" required value="{{ $m->icon }}">
                    </div>
                </div>
                @if ($m->is_submenu == 1)


                @else
                <div class="row mb-3" id="urledit" show>
                    <label for="url" class="col-md-4 col-form-label text-md-end">Url</label>
                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control" name="url" value="{{ $m->url }}">
                    </div>
                </div>

                @endif
        </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
</div>
</div>
@php
    $hit++
@endphp
@endforeach
<input type="hidden" id="hit" value="{{ $hit }}">
{{-- End Modal Edit --}}

@endsection


@section('js')
{{-- DataTable Start --}}
<script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
</script>
{{-- Datatable End --}}

{{-- Hide url Start --}}
<script>
    $("#is_submenu").change(function() {
        if(this.checked) {
            $("#urlnya").hide()
            $("#url").val('')
        }else{
            $("#urlnya").show()

        }
    });

    $("#is_submenuedit").change(function() {
        if(this.checked) {
            $("#urledit").hide()
            $("#url").val('')
        }else{
            $("#urledit").show()
        }
    });

    // let hit = $('#hit').val();
    // for(i=0; i <= hit; i++){
    //     $("#is_submenuedit"+i).change(function() {
    //         if(this.checked) {
    //             $("#urledit"+i).hide()
    //             $("#url"+i).val('')
    //         }else{
    //             $("#urledit"+i).show()
    //         }
    //     });
    //     console.log("is_submenuedit"+i);
    // }
</script>
{{-- Hide URL End --}}
@endsection
