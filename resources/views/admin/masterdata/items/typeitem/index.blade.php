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
                            <h4>Tipe Items</h4>
                        </div>
                        <div class="d-flex align-items-center position-relative my-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Search" id="searchItemsTable" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/masterdata/typeitems'])
                                <button type="button" class="btn btn-primary me-3" id="add-btn"
                                    onclick="create()">
                                    Tambah Tipe Item</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="typeItemTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-20px">No
                                </th>
                                <th class="min-w-125px">Coa</th>
                                <th class="min-w-125px">Nama</th>
                                <th class="min-w-125px">Deskripsi</th>
                                <th class="min-w-70px">Status</th>
                                <th class="min-w-70px">Aksi</th>
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
            $.get("{{ url('/admin/masterdata/typeitems/create') }}", {}, function(data, status) {
                $('#indexContent').hide()
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Tambah Tipe Item</button>'
                )
            });
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/typeitems/edit') }}/" + id, {}, function(data, status) {
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Tambah Tipe Item</button>'
                )
                $('#indexContent').hide()
                $('#content').html(data)
                $('#content').show()
            });
        }

        function tutupContent(){
            $('#content').hide()
            $('#indexContent').show()
        }


        var typeItemTable = $('#typeItemTable').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/masterdata/typeitems/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'coa_id',
                    name: 'coa_id'
                },
                {
                    data: 'name_type',
                    name: 'name_type'
                },
                {
                    data: 'description',
                    name: 'description'
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

        $('#searchtypeItemTable').keyup(function() {
            typeItemTable.search($(this).val()).draw()
        });

        $(document).on('click', '#deleteTypeItem', function(e) {
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
                title: 'Delete this data ?',
                text: "Data can't return back!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'No, Cancel!',
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
                            typeItemTable.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Tambah Tipe Item</button>'
                                )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Data masih aman :)',
                        'success'
                    )
                }
            })
        });
    </script>
@endsection
