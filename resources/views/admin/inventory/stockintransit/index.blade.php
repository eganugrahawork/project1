@extends('admin.layouts.main')

@section('content')
<div class="success-message" data-successmessage="{{ session('success') }}"></div>
<div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Stock In Transit</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl bg-warna py-4">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card bg-white">
            <div class="card-header border-0 pt-6">
                <div class="card-title align-items-start flex-column">
                    <div class="d-flex align-items-center position-relative my-1">
                       <h2>Stock In Transit</h2>
                    </div>
                    <div class="my-2">
                        @can('create', ['/admin/inventory/stock-in-transit'])
                        <div class="px-2">
                            <button class="btn btn-sm btn-primary mx-2" onclick="addTransitModal()">+</button><button class="btn btn-sm btn-primary" onclick="transitHistory()">Transit History</button>
                        </div>
                        @endcan
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="searchTableStockInTransit" class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="form-outline">
                        <input type="text" id="daterange" name="daterange" class="form-control text-gray-500" />
                    </div>
                    <div class="" id="loading-add">
                        <button type="button" onclick="filterStockInTransit()" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">

                <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="tableStockInTransit">
                    <thead>
                        <tr class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-top-2 border-gray-300 ">
                            <th class="min-w-70px align-middle border-left-2 border-gray-300" rowspan="2">Code</th>
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
                        <tr class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-gray-300">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
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

        function addTransitModal(){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/inventory/stock-in-transit/addtransitmodal') }}", {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>')
            })
        }
        function transitHistory(){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            // $.get("{{ url('/admin/procurement/items-receipt/addmodal') }}", {}, function(data, status){
                // $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>')
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

        function editModal(id){
            // $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            // $.get("{{ url('/admin/procurement/items-receipt/editmodal') }}/"+id, {}, function(data, status){
            //     $('#kontennya').html(data)
            //     $('#mainmodal').modal('toggle')
            //     $('#loading-add').html('')
            //     $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>')
            // })
        }
        function tutupModal(){
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
