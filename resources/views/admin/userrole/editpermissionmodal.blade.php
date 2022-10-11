<div class="table-responsive">

    <table class="table align-middle table-row-dashed">
    <tbody>
        <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th colspan="5" class="text-center">Menu</th>
        </tr>
        @foreach ($menu as $m)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $m->menu }}</td>
            <td>
                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                    <input class="form-check-input permission-menu" data-idrole="{{ $id_role }}" data-idmenu="{{ $m->id }}" data-permissiontype="create" type="checkbox" @php
                    $data = ['id_role' => $id_role, 'id_menu' => $m->id];
                        checkPermissionMenuCreate($data)
                    @endphp  />
                    <span class="form-check-label">Create</span>
                </label>
            </td>
            <td>
                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                    <input class="form-check-input permission-menu" data-idrole="{{ $id_role }}" data-idmenu="{{ $m->id }}" data-permissiontype="edit" type="checkbox" @php
                    $data = ['id_role' => $id_role, 'id_menu' => $m->id];
                        checkPermissionMenuEdit($data)
                    @endphp />
                    <span class="form-check-label">Edit</span>
                </label>
            </td>
            <td>
                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                    <input class="form-check-input permission-menu" data-idrole="{{ $id_role }}" data-idmenu="{{ $m->id }}" data-permissiontype="delete" type="checkbox" @php
                    $data = ['id_role' => $id_role, 'id_menu' => $m->id];
                        checkPermissionMenuDelete($data)
                    @endphp />
                    <span class="form-check-label">Delete</span>
                </label>
            </td>
        </tr>
        @endforeach
        <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th colspan="5" class="text-center">Submenu</th>
        </tr>
        @foreach ($submenu as $sm )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sm->usersubmenu->submenu }}</td>
                <td>
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                        <input class="form-check-input permission-submenu" data-idrole="{{ $id_role }}" data-idsubmenu="{{ $sm->id_submenu }}" data-permissiontype="create" type="checkbox" @php
                        $data = ['id_role' => $id_role, 'id_submenu' => $sm->id_submenu];
                            checkPermissionSubmenuCreate($data)
                        @endphp  />
                        <span class="form-check-label">Create</span>
                    </label>
                </td>
                <td>
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                        <input class="form-check-input permission-submenu" data-idrole="{{ $id_role }}" data-idsubmenu="{{ $sm->id_submenu }}" data-permissiontype="edit" type="checkbox" @php
                        $data = ['id_role' => $id_role, 'id_submenu' => $sm->id_submenu];
                            checkPermissionSubmenuEdit($data)
                        @endphp />
                        <span class="form-check-label">Edit</span>
                    </label>
                </td>
                <td>
                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                        <input class="form-check-input permission-submenu" data-idrole="{{ $id_role }}" data-idsubmenu="{{ $sm->id_submenu }}" data-permissiontype="delete" type="checkbox" @php
                        $data = ['id_role' => $id_role, 'id_submenu' => $sm->id_submenu];
                            checkPermissionSubmenuDelete($data)
                        @endphp />
                        <span class="form-check-label">Delete</span>
                    </label>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>



<script>
    $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
 $('.permission-menu').on('click',function() {
    const menuId = $(this).data('idmenu');
    const roleId = $(this).data('idrole');
    const permission = $(this).data('permissiontype')

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Ubah Permission Menu ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya Ubah!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: false
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
        url: "{{ route('permissionmenu') }}",
        type: 'post',
        data: {
            roleId: roleId,
            menuId: menuId,
            permission:permission
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


$('.permission-submenu').on('click',function() {
    const submenuId = $(this).data('idsubmenu');
    const roleId = $(this).data('idrole');
    const permission = $(this).data('permissiontype')

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Ubah Permission Menu ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya Ubah!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: false
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
        url: "{{ route('permissionsubmenu') }}",
        type: 'post',
        data: {
            roleId: roleId,
            submenuId: submenuId,
            permission:permission
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
</script>
