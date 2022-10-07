<div class="fv-row">
    <!--begin::Label-->
    <label class="fs-5 fw-bolder form-label mb-2">Menu Permissions</label>
    <!--end::Label-->
    <!--begin::Table wrapper-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <tbody class="text-gray-600 fw-bold">
                @foreach ($menu as $m)
                <tr>
                    <td class="text-gray-800"> <p>{{ $m->menu }}</p>
                    <td>
                        <label class="form-check form-check-custom form-check-solid me-9">
                            <input class="form-check-input user_access" data-idrole="{{ $id_role }}" data-idmenu="{{ $m->id }}" type="checkbox" @php
                            $data = ['id_role' => $id_role, 'id_menu' => $m->id];
                                checkAccess($data)
                            @endphp />
                        </label>

                    </td>
                    @if ($m->is_submenu ==1)
                        @php
                        $submenu = DB::select("select * from user_submenus where id_menu = $m->id");
                        @endphp
                    <td>
                        @foreach ($submenu as $sub)
                        <div class="row py-3">
                            <div class="col-lg-6">
                                {{ $sub->submenu }}
                            </div>
                            <div class="col-lg-6">
                                <label class="form-check form-check-custom form-check-solid me-9 ml-2">
                                    <input class="form-check-input user_access_submenus" data-idrole="{{ $id_role }}" data-idsubmenu="{{ $sub->id }}" type="checkbox" @php
                                                    $data = ['id_role' => $id_role, 'id_submenu' => $sub->id];
                                                    checkAccessSubmenu($data)
                                                    @endphp />
                                    </label>
                            </div>
                        </div>
                        @endforeach

                    </td>
                        @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary" onclick="closeWithReload()">Confirm</button>
        </div>
    </div>
</div>



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
        title: 'Ubah Akses Menu ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya Ubah!',
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
        }
    })
        }
    })
});

$('.user_access_submenus').on('click', function(){
    const SubmenuId = $(this).data('idsubmenu')
    const roleId = $(this).data('idrole')

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Ubah Akses Submenu ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya Ubah!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: false
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
        url: "{{ route('changeaccesssubmenu') }}",
        type: 'post',
        data: {
            roleId: roleId,
            submenuId: SubmenuId
        },
        success: function() {
            Swal.fire(
                'Success',
                'Access Changed',
                'success'
            )
        }
        })
        }
    })

})

function closeWithReload(){
    $('#mainmodal').modal('hide')
    location.reload()
}
</script>
