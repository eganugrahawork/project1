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
            <div class="py2">
                <a href="/admin/configuration/userrole" class="btn btn-sm btn-success">Role Page</a>
            </div>
            <h5 class="card-title">Set for User Access to Menues for : {{ $role }}</h5>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Menues</th>
                                <th class="text-center">Accessed</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $m )
                            @php
                                $data = [
                                    'id_role' =>$id_role,
                                    'id_menu' => $m->id
                                ]
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $m->menu }}</td>
                                    <td class="text-center">
                                        {{-- <div class="form-check">
                                            <input class="form-check-input user_access" id="" name="checkbox" type="checkbox" @php
                                                checkAccess($data)
                                            @endphp data-idrole="{{ $id_role }}" data-idmenu="{{ $m->id }}" disabled>
                                        </div> --}}

                                        <span data-feather="{{ checkAccess($data) }}"></span>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning text-white" type="button" data-bs-toggle="modal" data-bs-target="#accessModal{{ $m->id }}">Ubah Access</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
@foreach ($menu as $m)
@php
    $status = DB::select("select * from user_access_menus where id_role = $id_role and id_menu = $m->id");
@endphp
<div class="modal fade" id="accessModal{{ $m->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="accessModal{{ $m->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="accessModal{{ $m->id }}Label">{{ $role }} <span data-feather="arrow-right" class="align-text-center"></span> {{ $m->menu }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/configuration/useraccessmenu/updateaccess" method="post">
            <div class="modal-body">
                <input type="hidden" name="id_role" value="{{ $id_role }}">
                <input type="hidden" name="id_menu" value="{{ $m->id }}">
            @csrf
               <select name="status" class="form-select">
                @if ($status)
                <option value="0">Tidak diizinkan</option>
                <option value="1" selected>Izinkan</option>
                @else
                <option value="0" selected>Tidak diizinkan</option>
                <option value="1" >Izinkan</option>
                @endif
               </select>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Change</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
@endsection

@section('js')
{{-- <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $('.user_access').on('click',function() {
        const menuId = $(this).data('idmenu');
        const roleId = $(this).data('idrole');

        $.ajax({
            url: "{{ route('changeaccess') }}",
            type: 'post',
            data: {
                roleId: roleId,
                menuId: menuId
            },
            success: function() {
                Swal.fire(
                    'Success',
                    'Access Changed',
                    'success'
                )
                setTimeout(function(){
                            location.reload();
                        }, 1500);

            }
        })
    });
</script> --}}
<script>
    $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


 $('.user_access').on('click',function() {
    const menuId = $(this).data('idmenu');
    const roleId = $(this).data('idrole');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })



    swalWithBootstrapButtons.fire({
        title: 'Ubah Akses ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, hapus!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: false
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
        url: "{{ route('changeaccess') }}",
        type: 'post',
        data: {
            roleId: roleId,
            menuId: menuId
        },
        success: function() {
            Swal.fire(
                'Success',
                'Access Changed',
                'success'
            )
            setTimeout(function(){
                        location.reload();
                    }, 1500);

        }
    })

        }
    })



});
</script>

@endsection
