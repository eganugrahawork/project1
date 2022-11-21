<div class="table-responsive">

    <table class="table align-middle table-row-dashed">
        <tbody>
            <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th colspan="6" class="text-center">Permission on Menu</th>
            </tr>
            @foreach ($menu as $m)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $m->name }}</td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="approve" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuApprove($data) @endphp />
                            <span class="form-check-label">Approve</span>
                        </label>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="create" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuCreate($data) @endphp />
                            <span class="form-check-label">Create</span>
                        </label>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="edit" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuEdit($data) @endphp />
                            <span class="form-check-label">Edit</span>
                        </label>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="delete" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuDelete($data) @endphp />
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
    $('.permission-menu').on('click', function() {
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
                        permission: permission
                    },
                    success: function() {
                        Swal.fire(
                            'Success',
                            'Access Changed',
                            'success'
                        )
                        $('#accessModal').modal('toggle');
                    }
                })
            } else {
                $('#accessModal').modal('toggle');
            }
        })
    });
</script>
