@extends('admin.layouts.main')

@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
    <div class="row">
        <div class="col-12">
            <div id="content"></div>
            <div class="card" id="indexContent">
                <div class="card-header border-0">
                    <div class="card-title align-items-start flex-column">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h5 class="fw-bolder fs-4 text-gray-600">Return Penjualan</h5>
                        </div>
                        <div class="d-flex align-items-center position-relative my-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Search" id="searchtableRetur" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/procurement/retur'])
                                <button type="button" class="btn btn-primary me-3" onclick="create()">
                                    Tambahkan Return</button>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="tableRetur">
                            <thead>
                                <tr class="text-start text-uppercase text-gray-400 fw-bolder fs-7 gs-0">
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Nomor
                                        Penjualan</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Partner
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Tanggal
                                        Penjualan
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Pengaju
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Jatuh
                                        Tempo</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal
                                        Return</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600" style="border:none;">

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
            $.get("{{ url('/admin/selling/return/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambahkan Return</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/return/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambahkan Return</button>'
                )
            })
        }

        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/return/info') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambahkan Return</button>'
                )
            })
        }

        function approve(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/return/approveview') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambahkan Return</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableRetur').focus()

        }

        var tableRetur = $('#tableRetur').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/selling/return/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'retur_date',
                    name: 'retur_date'
                },
                {
                    data: 'qty_return',
                    name: 'qty_return'
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
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchtableRetur').keyup(function() {
            tableRetur.search($(this).val()).draw()
        });


        $(document).on('click', '#deleteRetur', function(e) {
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
                            tableRetur.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambahkan Return</button>'
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

        function exportPDF(id) {
            // e.preventDefault();
            const href = "{{ url('/admin/selling/return/exportpdf') }}/" + id
            console.log(href);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Export this Data ?',
                text: "Format Pdf",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Export',
                cancelButtonText: 'Cancel',
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
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambahkan Return</button>'
                            )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Cancel Export',
                        'success'
                    )
                }
            })
        }
    </script>
@endsection
