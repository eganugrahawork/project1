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
                            <h2>Selling</h2>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/selling/selling'])
                                <button type="button" class="btn btn-primary me-3" onclick="create()">
                                    Add Selling</button>
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
                                <th class="min-w-70px ">Number</th>
                                <th class="min-w-70px ">Customer</th>
                                <th class="min-w-70px ">Date</th>
                                <th class="min-w-70px ">Total</th>
                                <th class="min-w-70px ">Due Date</th>
                                <th class="min-w-70px ">Sales</th>
                                <th class="min-w-70px ">Status</th>
                                <th class="min-w-50px">Action</th>
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

    {{-- Main Modal --}}
    <div class="modal fade" id="mainmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-warna" id="mainmodal_header">
                    <h2 class="fw-bolder text-white">Selling</h2>
                    <div class="btn btn-sm btn-white" onclick="tutupModal()">
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
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-2" id="kontennya">
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Modal --}}
@endsection

@section('js')
    <script>
        $('.select-2').select2();

        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/purchase-order/addmodal') }}", {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Add Selling</button>'
                )
            })
        }

        function editModal(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/purchase-order/editmodal') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Add Selling</button>'
                )
            })
        }

        function infoModal(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/purchase-order/infomodal') }}/" + id, {}, function(data, status) {
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('')
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>'
                )
            })
        }
        // function approveModal(id){
        //     $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
        //     $.get("{{ url('/admin/procurement/purchase-order/aprovedmodal') }}/"+id, {}, function(data, status){
        //         $('#kontennya').html(data)
        //         $('#mainmodal').modal('toggle')
        //         $('#loading-add').html('')
        //         $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>')
        //     })
        // }
        function tutupModal() {
            $('#mainmodal').modal('toggle')
        }

        // var tablePo =  $('#tablePo').DataTable({
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
        //             {data: 'po_code', name: 'po_code'},
        //             {data: 'name', name: 'name'},
        //             {data: 'order_date', name: 'order_date'},
        //             {data: 'total_po', name: 'total_po', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
        //             // {data: 'due_date', name: 'delivery_date'},
        //             {data: 'statues', name: 'statues'},
        //             {data: 'action', name: 'action'}
        //             ],
        //     "bLengthChange": false,
        //     "bFilter": true,
        //     "bInfo": false
        // });

        // $('#searchTablePo').keyup(function () {
        //         tablePo.search($(this).val()).draw()
        // });


        // $(document).on('click', '#deletepo', function(e){
        //     e.preventDefault();
        //     const href = $(this).attr('href');

        //     const swalWithBootstrapButtons = Swal.mixin({
        //         customClass: {
        //         confirmButton: 'btn btn-success',
        //         cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     })

        //     swalWithBootstrapButtons.fire({
        //         title: 'Hapus data ini ?',
        //         text: "Data tidak bisa dikembalikan!",
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, hapus!',
        //         cancelButtonText: 'Tidak, Batalkan!',
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
        //                     tablePo.ajax.reload(null, false);
        //                     $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addPoModal()">Add Purchase Order</button>')
        //                 }
        //             })

        //         } else if (

        //         result.dismiss === Swal.DismissReason.cancel
        //         ) {
        //         swalWithBootstrapButtons.fire(
        //             'Cancelled',
        //             'Data anda masih aman :)',
        //             'success'
        //         )
        //         }
        //     })
        // });

        // function exportPDF(id){
        //     // e.preventDefault();
        //     const href = "{{ url('/admin/procurement/purchase-order/exportpdf') }}/"+id
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
