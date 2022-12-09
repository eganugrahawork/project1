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
                        <div class="d-flex align-items-center position-relative ">
                            <h2>Stock In Transit</h2>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row ">
                        <div class="d-flex justify-content-start">
                            @can('create', ['/admin/inventory/stock-in-transit'])
                                <div class="px-2">
                                    <button class="btn btn-sm btn-primary mx-2" onclick="addTransitModal()">+</button><button
                                        class="btn btn-sm btn-primary" onclick="transitHistory()">Transit History</button>
                                </div>
                            @endcan
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="text" id="daterange" name="daterange"
                                        class="form-control text-gray-500" />
                                </div>
                                <div class="" id="loading-add">
                                    <button type="button" onclick="filterStock()" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchTableStock" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="tableStockInTransit">
                            <thead>
                                <tr
                                    class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-top-2 border-gray-300 ">
                                    <th class="min-w-70px align-middle border-left-2 border-gray-300" rowspan="2">Code
                                    </th>
                                    <th class="min-w-70px align-middle" rowspan="2">Items</th>
                                    <th class="min-w-70px align-middle" rowspan="2">Partner</th>
                                    <th class="min-w-70px align-middle" rowspan="2">Kemasan</th>
                                    <th class="min-w-70px align-middle" rowspan="2">Box </th>
                                    <th class="min-w-70px align-middle" colspan="2">Start Stock</th>
                                    <th class="min-w-70px align-middle" colspan="4">Received</th>
                                    <th class="min-w-70px align-middle" colspan="4">Delivery Order </th>
                                    <th class="min-w-70px align-middle" colspan="2">End Stock</th>
                                    <th class="min-w-70px align-middle" rowspan="2">Option</th>
                                </tr>
                                <tr
                                    class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-gray-300">
                                    <th class="align-middle">Lt/Kg</th>
                                    <th class="align-middle">Box</th>
                                    <th class="align-middle">Lt/Kg</th>
                                    <th class="align-middle">Box</th>
                                    <th class="align-middle">Retur Lt/Kg</th>
                                    <th class="align-middle">Retur Box</th>
                                    <th class="align-middle">Lt/Kg</th>
                                    <th class="align-middle">Box</th>
                                    <th class="align-middle">Retur Lt/Kg</th>
                                    <th class="align-middle">Retur Box</th>
                                    <th class="align-middle">Lt/Kg</th>
                                    <th class="align-middle">Box</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>P2202R2</td>
                                    <td>Mercusuar A2201</td>
                                    <td>PT apa gitu ya</td>
                                    <td>PEORDA BOX 2203</td>
                                    <td>APAYA</td>
                                    <td>0000</td>
                                    <td>20939</td>
                                    <td>201928</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                    <td>0000</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>

    {{-- Main Modal --}}
    <div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header" id="mainmodal_header">
                    <h2 class="fw-bolder">Stock In Transit</h2>
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
    {{-- End Main Modal --}}
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
    </script>

    <script>
        function addTransitModal() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/inventory/stock-in-transit/addtransitmodal') }}", {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>'
                )
            })
        }

        function transitHistory() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            // $.get("{{ url('/admin/procurement/items-receipt/addmodal') }}", {}, function(data, status){
            // $('#kontennya').html(data)
            $('#mainmodal').modal('toggle')
            $('#loading-add').html(
                '<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>')
            // })
        }

        function filterStockInTransit() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            let getData = {
                'date_range': $('#daterange').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/admin/inventory/stock-in-transit/filter') }}",
                data: getData,
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    $('#loading-add').html(
                        '<button type="button" onclick="filterStockInTransit()" class="btn btn-primary"><i class = "fas fa-search" ></i></button>'
                    )
                }

            });
        }

        function editModal(id) {
            // $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            // $.get("{{ url('/admin/procurement/items-receipt/editmodal') }}/"+id, {}, function(data, status){
            //     $('#kontennya').html(data)
            //     $('#mainmodal').modal('toggle')
            //     $('#loading-add').html('')
            //     $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>')
            // })
        }

        function tutupModal() {
            $('#mainmodal').modal('toggle')
        }

        // var tableStockInTransit =  $('#tableStockInTransit').DataTable({
        //     serverside : true,
        //     processing : true,
        //     ajax : {
        //             url : "{{ url('/admin/procurement/purchase-order/list') }}"
        //             },
        //             columns:
        //             [
        //             {
        //             data: 'DT_RowIndex',
        //             searchable: false
        //         },
        //             {data: 'code', name: 'code'},
        //             {data: 'partner_id', name: 'partner_id'},
        //             {data: 'order_date', name: 'order_date'},
        //             {data: 'price', name: 'price', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
        //             {data: 'delivery_date', name: 'delivery_date'},
        //             {data: 'status', name: 'status'},
        //             {data: 'action', name: 'action'}
        //             ],
        //     "bLengthChange": false,
        //     "bFilter": true,
        //     "bInfo": false
        // });

        // $('#searchTableStockInTransit').keyup(function () {
        //         tableStockInTransit.search($(this).val()).draw()
        // });
    </script>
@endsection
