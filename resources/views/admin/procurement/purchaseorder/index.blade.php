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
                            <h5 class="fw-bolder fs-4 text-gray-600">Purchase Order</h5>
                        </div>

                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/procurement/purchase-order'])
                                <button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">
                                    Tambah Purchase Order</button>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-lg-6 justify-content-start align-items-center position-relative my-1">
                            <button type="button" class="btn btn-sm btn-success" data-kt-menu-trigger="click"
                                data-kt-menu-placement="top-start">
                                Export
                                <span class="svg-icon svg-icon-5 rotate-180 ms-3 me-0"><i
                                        class="bi bi-arrow-up-circle"></i></span>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold fs-8 w-100px py-2"
                                data-kt-menu="true">
                                <div class="menu-item px-2">
                                    <a href="/admin/procurement/purchase-order/exportexcel" target="_blank"
                                        class="menu-link px-2">
                                        <span><i class="bi bi-file-earmark-excel"></i></span> Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div class="form-group col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Search" id="searchTablePo" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="tablePo">
                        <thead>
                            <tr class="text-start text-uppercase text-gray-400 fw-bolder fs-7 gs-0">
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Kode PO</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Partner
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Tanggal
                                    Order
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Total</th>
                                {{-- <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Due Date</th> --}}
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ">Status</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" style="border:none;">

                        </tbody>
                    </table>
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
            $.get("{{ url('/admin/procurement/purchase-order/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Purchase Order</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/purchase-order/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Purchase Order</button>'
                )
            })
        }

        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/purchase-order/info') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Purchase Order</button>'
                )
            })
        }

        function approve(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/purchase-order/approveview') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Purchase Order</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchTablePo').focus()

        }

        var tablePo = $('#tablePo').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/procurement/purchase-order/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'po_code',
                    name: 'po_code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tgl_order',
                    name: 'tgl_order'
                },
                {
                    data: 'total_po',
                    name: 'total_po',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                },
                // {data: 'due_date', name: 'delivery_date'},
                {
                    data: 'statues',
                    name: 'statues'
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

        $('#searchTablePo').keyup(function() {
            tablePo.search($(this).val()).draw()
        });


        $(document).on('click', '#deletepo', function(e) {
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
                            tablePo.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Purchase Order</button>'
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
            const href = "{{ url('/admin/procurement/purchase-order/exportpdf') }}/" + id
            console.log(href);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Export Data Ini ?',
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
                                '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Purchase Order</button>'
                            )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Batal Melakukan Export',
                        'success'
                    )
                }
            })
        }
    </script>
@endsection
