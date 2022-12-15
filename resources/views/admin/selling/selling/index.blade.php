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
                            <h2>Penjualan</h2>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/selling/selling'])
                                <button type="button" class="btn btn-primary me-3" onclick="create()">
                                    Tambah Penjualan</button>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-lg-3 d-flex">
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
                            <a class="btn btn-sm btn-primary input-group-text" onclick=""><i
                                    class="lab la-searchengin"></i></a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center position-relative justify-content-end  my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchtableSelling" type="text">
                            </div>
                        </div>
                    </div>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableSelling">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-20px">No</th>
                                <th class="min-w-70px ">Nomor</th>
                                <th class="min-w-70px ">Pelanggan</th>
                                <th class="min-w-70px ">Tanggal</th>
                                <th class="min-w-70px ">Total</th>
                                <th class="min-w-70px ">Jatuh Tempo</th>
                                <th class="min-w-70px ">Penjual</th>
                                <th class="min-w-70px ">Status</th>
                                <th class="min-w-50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">

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
        $('.select-2').select2();

        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/create') }}", {}, function(data, status) {
                $('#content').show()
                $('#indexContent').hide()
                $('#content').html(data)
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Penjualan</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/edit') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Penjualan</button>'
                )
            })
        }

        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/info') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>'
                )
            })
        }
        function approve(id){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/approveview') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('')
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>')
            })
        }
        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableSelling').focus()
        }

        var tableSelling =  $('#tableSelling').DataTable({
            serverside : true,
            processing : true,
            ajax : {
                    url : "{{ url('/admin/selling/selling/list') }}"
                    },
                    columns:
                    [
                    {
                    data: 'DT_RowIndex',
                    searchable: false
                },
                    {data: 'no_selling', name: 'no_selling'},
                    {data: 'name', name: 'name'},
                    {data: 'tgl_jual', name: 'tgl_jual'},
                    {data: 'total_amount', name: 'total_amount', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
                    // {data: 'due_date', name: 'delivery_date'},
                    {data: 'due_date', name: 'due_date'},
                    {data: 'nama_sales', name: 'nama_sales'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
                    ],
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false
        });

        $('#searchtableSelling').keyup(function () {
                tableSelling.search($(this).val()).draw()
        });


        $(document).on('click', '#deleteselling', function(e){
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
                    $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
                    $.ajax({
                        type:"GET",
                        url: href,
                        success:function(response){
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                            tableSelling.ajax.reload(null, false);
                            $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="create()">Create Seling</button>')
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

        // function exportPDF(id){
        //     // e.preventDefault();
        //     const href = "{{ url('/admin/selling/selling/exportpdf') }}/"+id
        //     console.log(href);

        //     const swalWithBootstrapButtons = Swal.mixin({
        //         customClass: {
        //         confirmButton: 'btn btn-success',
        //         cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     })

        //     swalWithBootstrapButtons.fire({
        //         title: 'Export this Data ?',
        //         text: "Format Pdf",
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonText: 'Export',
        //         cancelButtonText: 'Cancel',
        //         reverseButtons: false
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
        //             $.ajax({
        //                 type:"GET",
        //                 url: href,
        //                 success:function(response){
        //                     Swal.fire(
        //                         'Success',
        //                         response.success,
        //                         'success'
        //                     )
        //                     $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>')
        //                 }
        //             })

        //         } else if (

        //         result.dismiss === Swal.DismissReason.cancel
        //         ) {
        //         swalWithBootstrapButtons.fire(
        //             'Cancelled',
        //             'Cancel Export',
        //             'success'
        //         )
        //         }
        //     })
        // }
    </script>
@endsection
