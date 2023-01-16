@extends('admin.layouts.main')

@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>

    <div class="row">
        <div class="col-12">
            <div id="content"></div>
            <div class="card" id="indexContent">
                <div class="card-header border-0">
                    <div class="card-title align-items-start flex-column">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h5>Chart Of Account</h5>
                        </div>
                        <div class="d-flex align-items-center position-relative my-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Search" id="searchCoaTable" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/masterdata/coa'])
                                <button type="button" class="btn btn-primary me-3" onclick="create()">
                                    Tambah Coa</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 ">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="coaTable">
                            <thead>
                                <tr class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                    <th class="min-w-20px">No
                                    </th>
                                    <th class="min-w-70px">Parent</th>
                                    <th class="min-w-70px">Coa</th>
                                    <th class="min-w-70px">Deskripsi</th>
                                    <th class="min-w-70px">Status</th>
                                    <th class="min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-md text-secondary mb-0" style="border:none;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>

@endsection

@section('js')
    <script>
        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/coa/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Tambah Coa</button>'
                    )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/coa/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Tambah Coa</button>'
                    )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchCoaTable').focus()
        }

        var coaTable = $('#coaTable').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ url('/admin/masterdata/coa/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'parent',
                    name: 'parent'
                },
                {
                    data: 'coa',
                    name: 'coa'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchCoaTable').keyup(function() {
            coaTable.search($(this).val()).draw()
        });

        $(document).on('click', '#deletecoa', function(e) {
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
                            coaTable.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Tambah Coa</button>'
                                )
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
