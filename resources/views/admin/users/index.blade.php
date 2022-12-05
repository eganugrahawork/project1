@extends('admin.layouts.main')


@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>


    <div class="row">
        <!--begin::Post-->
        <div class="col-12">
            <div id="content"></div>
            <div class="card" id="indexContent">
                <!--begin::Card header-->
                <div class="card-header pb-0">
                    <!--begin::Card title-->
                    <div class="card-title align-items-start flex-column">
                        <h5 class="mb-3">Users</h5>
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Search" id="searchUserTable" type="text">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-toolbar" id="loading-add">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            @if (auth()->user()->userrole->role === 'Super Admin')
                                <a class="btn btn-light-primary me-3" href="/admin/configuration/menu">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="bi bi-menu-button-wide"></i>
                                    </span>
                                    Configuration</a>
                            @endif

                            @can('create', ['/admin/users'])
                                <button type="button" class="btn btn-primary" onclick="create()">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="bi bi-plus-square"></i>
                                    </span>
                                    Add User</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="usersTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">User</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Role</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Region
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Created
                                        at</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-md fw-bold" style="border:none;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function create() {
            $('#content').html(
                        '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>'
                    )
            $.get("{{ url('/admin/users/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
            })
        }

        function edit(id) {
            $.get("{{ url('/admin/users/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
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
                    $('#loading-add').append(
                        '<div class="spinner-grow text-success" role="status" id="loadingnyanih"><span class="sr-only"></span></div>'
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
                            $('#loadingnyanih').remove()
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
