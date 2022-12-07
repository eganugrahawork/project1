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
                            <h5 class="fw-bolder text-gray-600">Procurement Invoice</h5>
                        </div>
                        <div class="d-flex align-items-center position-relative my-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Search" id="searchTableInvoice" type="text">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/procurement/invoice'])
                                <button type="button" class="btn btn-primary me-3" onclick="create()">
                                    Create Invoice</button>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-start col-lg-4">
                        <select name="status" id="status" class="form-select form-select-md select-2">
                            <option value="0">All</option>
                            <option value="1">Lunas</option>
                            <option value="2">Belum Lunas</option>
                        </select>
                        <select name="month" id="month" class="form-select form-select-md select-2">
                            <option value="0">Desember</option>
                        </select>
                        <select name="years" id="years" class="form-select form-select-md select-2">
                            <option value="0">2020</option>
                        </select>
                        <button class="btn btn-sm btn-primary input-group-text" type="button"><i
                                class="lab la-searchengin"></i></a>


                    </div>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableInvoice">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No Invoice
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Partner</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Invoice
                                    Number</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Total</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Balance</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Due Date</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Status</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-md text-gray-600" style="border:none;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.select-2').select2()

        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/invoice/info') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Create Invoice</button>'
                )
            })
        }

        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/invoice/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Create Invoice</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/invoice/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Create Invoice</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchTableInvoice').focus();

        }

        // var tableInvoice =  $('#tableInvoice').DataTable({
        //     serverside : true,
        //     processing : true,
        //     ajax : {
        //             url : "{{ url('/admin/procurement/items-receipt/list') }}"
        //             },
        //             columns:
        //             [
        //             {
        //             data: 'DT_RowIndex',
        //             searchable: false
        //         },
        //             {data: 'do_number', name: 'do_number'},
        //             {data: 'receipt_date_filter', name: 'receipt_date_filter'},
        //             {data: 'number_po', name: 'number_po'},
        //             {data: 'name', name: 'name'},
        //             {data: 'order_datenya', name: 'order_datenya'},
        //             {data: 'total_po', name: 'total_po',
        //             render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')},
        //             {data: 'total_discount', name: 'total_discount'},
        //             {data: 'total_price', name: 'total_price', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')},
        //             {data: 'action', name: 'action'}
        //             ],
        //     "bLengthChange": false,
        //     "bFilter": true,
        //     "bInfo": false
        // });

        // $('#searchTableInvoice').keyup(function () {
        //         tableInvoice.search($(this).val()).draw()
        // });

        $(document).on('click', '#deleteItemReceipt', function(e) {
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
                            tableInvoice.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" onclick="create()">Add Item Receipt</button>'
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
