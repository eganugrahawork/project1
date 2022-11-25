<h5 class="text-muted text center">Permission Control</h5>
<div class="table-responsive">
    <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-1 position-absolute ms-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                    transform="rotate(45 17.0365 15.1223)" fill="black" />
                <path
                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                    fill="black" />
            </svg>
        </span>
        <input type="text" id="searchTablePermission" class="form-control form-control-solid w-250px ps-15"
            placeholder="Search.." />
    </div>
    <table class="table align-middle table-row-dashed" id="tablePermission">
        <thead>
            <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th>No</th>
                <th>Menu</th>
                <th>Approve</th>
                <th>Create</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

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
                        checkPermissionMenuApprove($data) @endphp onclick="changePermission(this)"/>

                        </label>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="create" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuCreate($data) @endphp  onclick="changePermission(this)" />

                        </label>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="edit" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuEdit($data) @endphp  onclick="changePermission(this)" />

                        </label>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                            <input class="form-check-input permission-menu" data-idrole="{{ $role_id }}"
                                data-idmenu="{{ $m->id }}" data-permissiontype="delete" type="checkbox"
                                @php
$data = ['role_id' => $role_id, 'menu_id' => $m->id];
                        checkPermissionMenuDelete($data) @endphp  onclick="changePermission(this)" />

                        </label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



<script>
    var tablePermission = $('#tablePermission').DataTable({
        "pageLength": 5,
        "info": false
    });
    $('#searchTablePermission').keyup(function() {
        tablePermission.search($(this).val()).draw()
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changePermission(e) {
        const menuId = $(e).data('idmenu');
        const roleId = $(e).data('idrole');
        const permission = $(e).data('permissiontype')

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
    };


</script>
