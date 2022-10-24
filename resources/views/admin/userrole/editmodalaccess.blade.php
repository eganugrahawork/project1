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
                    <td class="text-gray-800"> <p>{{ $m->name }}</p>
                    <td>
                        <label class="form-check form-check-custom form-check-solid me-9">
                            <input class="form-check-input user_access" data-idrole="{{ $role_id }}" data-idmenu="{{ $m->id }}" type="checkbox" @php
                            $data = ['role_id' => $role_id, 'menu_id' => $m->id];
                                checkAccess($data)
                            @endphp />
                        </label>

                    </td>
                    @php
                        $submenu = DB::connection('masterdata')->select("select * from menus where parent = $m->id");
                    @endphp
                    @if ($submenu)

                    <td>
                        @foreach ($submenu as $sub)
                            @php
                                $subonsubmenu = DB::connection('masterdata')->select("select * from menus where parent = $sub->id");
                            @endphp

                            @if ($subonsubmenu)
                            <div class="row py-3">
                                <div class="col-lg-3 mt-2">
                                    {{ $sub->name }}
                                </div>
                                <div class="col-lg-3 mt-2">
                                    <label class="form-check form-check-custom form-check-solid me-9 ml-2">
                                        <input class="form-check-input user_access" data-idrole="{{ $role_id }}" data-idmenu="{{ $sub->id }}" type="checkbox" @php
                                                        $data = ['role_id' => $role_id, 'menu_id' => $sub->id];
                                                        checkAccess($data)
                                                        @endphp />
                                        </label>
                                </div>

                                    @foreach ($subonsubmenu as $sosm)
                                    <div class="col-lg-3 mt-2">
                                        {{ $sosm->name }}
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        <label class="form-check form-check-custom form-check-solid me-9 ml-2">
                                            <input class="form-check-input user_access" data-idrole="{{ $role_id }}" data-idmenu="{{ $sosm->id }}" type="checkbox" @php
                                                            $data = ['role_id' => $role_id, 'menu_id' => $sosm->id];
                                                            checkAccess($data)
                                                            @endphp />
                                            </label>
                                    </div>
                                    <div class="col-lg-3 mt-2"></div>
                                    <div class="col-lg-3 mt-2"></div>
                                    @endforeach
                                </div>
                            @else

                            <div class="row py-3">
                                <div class="col-lg-3">
                                    {{ $sub->name }}
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-check form-check-custom form-check-solid me-9 ml-2">
                                        <input class="form-check-input user_access" data-idrole="{{ $role_id }}" data-idmenu="{{ $sub->id }}" type="checkbox" @php
                                                        $data = ['role_id' => $role_id, 'menu_id' => $sub->id];
                                                        checkAccess($data)
                                                        @endphp />
                                        </label>
                                </div>
                            </div>
                            @endif
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
        }else{
            $('#accessModal').modal('toggle');
        }
    })
});


function closeWithReload(){
    $('#mainmodal').modal('hide')
    location.reload()
}
</script>
