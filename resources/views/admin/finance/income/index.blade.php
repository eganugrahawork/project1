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
                            <h5 class="fw-bolder text-gray-600">Jurnal Masuk</h5>
                        </div>
                    </div>

                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                            @can('create', ['/admin/finance/income'])
                                <button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">
                                    Tambah Pemasukan</button>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-start col-lg-4">
                        <select name="month" id="month" class="form-select form-select-md select-2">
                            <option value="0">Desember</option>
                        </select>
                        <select name="years" id="years" class="form-select form-select-md select-2">
                            <option value="0">2020</option>
                        </select>
                        <button class="btn btn-sm btn-primary input-group-text" type="button"><i
                                class="lab la-searchengin"></i></a>

                    </div>
                    <div class="d-flex justify-content-end position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchtableIncome" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="tableIncome">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Coa Kredit
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Coa Debit
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Total</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Keterangan</th>
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
    </div>
@endsection

@section('js')
    <script>
        $('.select-2').select2()

        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/finance/income/info') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Pemasukan</button>'
                )
            })
        }

        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/finance/income/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Pemasukan</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/finance/income/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Pemasukan</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableIncome').focus();

        }

        var tableIncome = $('#tableIncome').DataTable({
            serverside: true,
            processing: true,
            ajax: {
                url: "{{ url('/admin/finance/income/list') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'invoice_date',
                    name: 'invoice_date'
                },
                {
                    data: 'due_date',
                    name: 'due_date'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price',
                    name: 'price',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                },
                {
                    data: 'balance',
                    name: 'balance',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
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

        $('#searchtableIncome').keyup(function() {
            tableIncome.search($(this).val()).draw()
        });

        $(document).on('click', '#deleteInvoice', function(e) {
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
                            tableIncome.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">Tambah Pemasukan</button>'
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
