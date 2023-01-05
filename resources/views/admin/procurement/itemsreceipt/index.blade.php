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
                       <h5 class="fw-bolder text-gray-600">Penerimaan Barang</h5>
                    </div>
                   
                </div>
                <div class="card-toolbar">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-10">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Penerimaan Perbulan
                                        </p>
                                        <h5 class="font-weight-bolder" id="total_penerimaan">
                                            -
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="loading-add">

                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-lg-8 d-flex ">
                        @can('create', ['/admin/procurement/items-receipt'])
                            <div class="px-2">
                                <button type="button" class="btn btn-sm btn-primary" onclick="create()">
                                    +</button>
                            </div>
                        @endcan
                        <div class="px-2">
                            <button type="button" class="btn btn-sm btn-success" data-kt-menu-trigger="click"
                                data-kt-menu-placement="top-start">
                                Export
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold fs-8 w-100px py-2"
                                data-kt-menu="true">
                                <div class="menu-item px-2">
                                    <a href="/admin/procurement/items-receipt/exportexcel" target="_blank"
                                        class="menu-link px-2">
                                        <span><i class="bi bi-file-earmark-excel"></i></span> Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <select name="month" id="month" class="form-select form-select-md select-2">
                            @foreach ($month as $m)
                                <option value="{{ $m }}">{{ $m }}</option>
                            @endforeach
                        </select>
                        <select name="years" id="years" class="form-select form-select-md select-2">
                            @foreach ($years as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                        <div class="px-2">

                            <button class="btn btn-sm btn-info input-group-text" onclick=""><i
                                    class="lab la-searchengin"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-end">
                        <div class="form-group col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchTableItemsReceipt" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="tableItemsReceipt">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Nomor Pengiriman</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal Diterima</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Nomor PO</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Partner</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal Order</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Harga</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Diskon</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Value</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Aksi</th>
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
    $('.select-2').select2();
        function info(id){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/items-receipt/info') }}/"+id, {}, function(data, status){
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html('')
            })
        }

        function create(){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/items-receipt/create') }}", {}, function(data, status){
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html('')
            })
        }
        function edit(id){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/items-receipt/edit') }}/"+id, {}, function(data, status){
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html('')
            })
        }
        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchTableItemsReceipt').focus();

        }

        var tableItemsReceipt =  $('#tableItemsReceipt').DataTable({
            serverside : true,
            processing : true,
            ajax : {
                    url : "{{ url('/admin/procurement/items-receipt/list') }}"
                    },
                    columns:
                    [
                    {
                    data: 'DT_RowIndex',
                    searchable: false
                },
                    {data: 'do_number', name: 'do_number'},
                    {data: 'receipt_date_filter', name: 'receipt_date_filter'},
                    {data: 'number_po', name: 'number_po'},
                    {data: 'name', name: 'name'},
                    {data: 'order_datenya', name: 'order_datenya'},
                    {data: 'total_po', name: 'total_po',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')},
                    {data: 'total_discount', name: 'total_discount'},
                    {data: 'total_price', name: 'total_price', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')},
                    {data: 'action', name: 'action'}
                    ],
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchTableItemsReceipt').keyup(function () {
                tableItemsReceipt.search($(this).val()).draw()
        });

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
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batalkan!',
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
                            tableItemsReceipt.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" onclick="create()">Add Item Receipt</button>'
                            )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Data anda masih aman :)',
                        'success'
                    )
                }
            })
        });
</script>

@endsection
