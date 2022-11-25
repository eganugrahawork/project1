@extends('admin.layouts.main')


@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $title }}</h1>
                <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-gray-600">Users</li>

                </ul>
            </div>
        </div>
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl bg-warna py-4">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->
            <div class="card bg-white">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title align-items-start flex-column">
                        <h2 class="mb-3">Users</h2>
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" id="searchUserTable" class="form-control form-control-solid w-250px ps-15"
                                placeholder="Search" />
                        </div>
                    </div>
                    <div class="card-toolbar">

                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            @if (auth()->user()->userrole->role === 'Super Admin')
                                <a class="btn btn-light-primary me-3" href="/admin/configuration/menu">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="bi bi-menu-button-wide"></i>
                                    </span>
                                    Configuration</a>
                            @endif

                            @can('create', ['/admin/users'])
                                <button type="button" class="btn btn-primary" onclick="addModal()">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="bi bi-plus-square"></i>
                                    </span>
                                    Add User</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="usersTable">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                                <th class="min-w-50px">No</th>
                                <th class="min-w-80px">User</th>
                                <th class="min-w-80px">Email</th>
                                <th class="min-w-80px">Role</th>
                                <th class="min-w-80px">Region</th>
                                <th class="min-w-80px">Created at</th>
                                <th class="min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header" id="mainmodal_header">
                    <h2 class="fw-bolder">Users</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="tutupModal()">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="kontennya">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function addModal() {
            $.get("{{ url('/admin/users/addmodal') }}", {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
            })
        }

        function editModal(id) {
            $.get("{{ url('/admin/users/editmodal') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
            })
        }

        function tutupModal() {
            $('#mainmodal').modal('toggle')
        }


        var usersTable = $('#usersTable').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/users/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'user',
                    name: 'user',
                    class: 'd-flex align-items-center'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'region',
                    name: 'region'
                },
                {
                    data: 'created',
                    name: 'created'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });


        $('#searchUserTable').keyup(function() {
            usersTable.search($(this).val()).draw()
        });

        $(document).on('click', '#deleteUsers', function(e) {
            e.preventDefault();


            const href = $(this).attr('href');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus data ini ?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, hapus!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loading-add').html(
                        '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>'
                        )
                    $.ajax({
                        type: "GET",
                        url: href,
                        success: function(response) {
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                            usersTable.ajax.reload(null, false);

                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Data anda masih aman :)',
                        'success'
                    )
                }
            })
        });
    </script>


@endsection
