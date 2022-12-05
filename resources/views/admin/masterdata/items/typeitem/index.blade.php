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
                            <h4>Type Items</h4>
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
                                    Add Type Items</button>
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
                                <th class="min-w-125px">Type Code</th>
                                <th class="min-w-125px">Name Type</th>
                                <th class="min-w-125px">Description</th>
                                <th class="min-w-70px">Status</th>
                                <th class="min-w-70px">Action</th>
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
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <div class="modal-content">
                <div class="modal-header" id="mainmodal_header">
                    <h2 class="fw-bolder">Items</h2>
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
        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/typeitems/create') }}", {}, function(data, status) {
                $('#indexContent').hide()
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Add Type Items</button>'
                )
            });
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/typeitems/edit') }}/" + id, {}, function(data, status) {
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Add Type Items</button>'
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
                    data: 'type_code',
                    name: 'type_code'
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
                                '<button type="button" class="btn btn-primary me-3" id="add-btn" onclick="create()">Add Type</button>'
                                )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Data Still Safe :)',
                        'success'
                    )
                }
            })
        });
    </script>
@endsection
