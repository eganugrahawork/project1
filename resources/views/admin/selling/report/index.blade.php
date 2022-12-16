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
                            <h5 class="fw-bolder text-gray-600">Laporan Penjualan</h5>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/selling/selling'])
                                <button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">
                                    +</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-lg-8 d-flex">
                            <div class="col-lg-3">
                                <select name="partner_id" id="partner_id" class="form-select form-select-md select-2">
                                    <option value="">Partner</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="daterange" id="daterange" class="form-control form-control-md">
                            </div>
                            <div class="col-lg-2">

                                <a class="btn btn-sm btn-info input-group-text" onclick=""><i
                                    class="lab la-searchengin"></i></a>
                                </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center position-relative justify-content-end  my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchtableReportSelling" type="text">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="tableReportSelling">
                        <thead>
                            <tr class="text-start text-uppercase text-gray-400 fw-bolder fs-7 gs-0">
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Produk</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Sum Of Pcs
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Sum Of Lt/Kg
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Sum Of Total
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Sum Of PPN
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Sum Of Total
                                    Of PPN</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Average Of
                                    Harga Pokok</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Average Of
                                    Harga Per Kemasan</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Average Of
                                    Harga Per Liter</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Average
                                    Laba/Rugi Per Liter</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Percent</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Average
                                    Laba/Rugi Per Produk</th>
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
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#daterange").val(start.format('YYYY-MM-DD') + " - " + end.format('YYYY-MM-DD'));
        }

        $("#daterange").daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            }
        }, cb);

        cb(start, end);
        $('.select-2').select2();
    </script>

    <script>

        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/create') }}", {}, function(data, status) {
                $('#content').show()
                $('#indexContent').hide()
                $('#content').html(data)
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">+</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/edit') }}/" + id, {}, function(data, status) {
                $('#content').show()
                $('#indexContent').hide()
                $('#content').html(data)
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">+</button>'
                )
            })
        }

        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/info') }}/" + id, {}, function(data, status) {
                $('#content').show()
                $('#indexContent').hide()
                $('#content').html(data)
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">+</button>'
                )
            })
        }

        function approve(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/selling/selling/approveview') }}/" + id, {}, function(data, status) {
                $('#content').show()
                $('#indexContent').hide()
                $('#content').html(data)
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">+</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableReportSelling').focus()
        }

        var tableReportSelling = $('#tableReportSelling').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/selling/selling/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'no_selling',
                    name: 'no_selling'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tgl_jual',
                    name: 'tgl_jual'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                },
                // {data: 'due_date', name: 'delivery_date'},
                {
                    data: 'due_date',
                    name: 'due_date'
                },
                {
                    data: 'nama_sales',
                    name: 'nama_sales'
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

        $('#searchtableReportSelling').keyup(function() {
            tableReportSelling.search($(this).val()).draw()
        });


        $(document).on('click', '#deleteselling', function(e) {
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
                            tableReportSelling.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Create Seling</button>'
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
