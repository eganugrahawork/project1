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
                       <h5>Unit Of Measure</h5>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchUomTable" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                        @can('create', ['/admin/masterdata/uom'])
                            <button type="button" class="btn btn-primary me-3" onclick="create()">
                            Add UOM</button>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="uomTable">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-20px">No
                            </th>
                            <th class="min-w-125px">Nama UoM</th>
                            <th class="min-w-125px">Simbol</th>
                            <th class="min-w-125px">Keterangan</th>
                            <th class="min-w-70px">Action</th>
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
        function create(){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/uom/create') }}", {}, function(data, status){
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3"  onclick="create()">Add UOM</button>')
            })
        }
        function edit(id){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/uom/edit') }}/"+id, {}, function(data, status){
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3"  onclick="create()">Add UOM</button>')
            })
        }
        function tutupContent(){
        $('#content').hide()
        $('#indexContent').show()
        }



        var tableUom=  $('#uomTable').DataTable({
                    serverside : true,
                    processing : true,
                    ajax : {
                        url : "{{ url('/admin/masterdata/uom/list') }}"
                    },
                    columns:
                    [
                        {
                            data: 'DT_RowIndex',
                            searchable: false
                        },
                        {data: 'name', name: 'name'},
                        {data: 'symbol', name: 'symbol'},
                        {data: 'description' ,name: 'description'},
                        {data: 'action' ,name: 'action'},
                    ],
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false
        });

        $('#searchUomTable').keyup(function () {
                tableUom.search($(this).val()).draw()
        });



        $(document).on('click', '#deleteuom', function(e){
            e.preventDefault();
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
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
                    $.ajax({
                        type:"GET",
                        url: href,
                        success:function(response){
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                            tableUom.ajax.reload(null, false);
                            $('#loading-add').html('<button type="button" class="btn btn-primary me-3"  onclick="create()">Add UOM</button>')
                        }
                    })
                // document.location.href = href;


                } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data anda masih aman :)',
                    'success'
                )
                }
            })
        })

</script>

@endsection
