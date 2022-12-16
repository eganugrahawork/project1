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
                            <h5 class="fw-bolder text-gray-600">Asset</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-start col-lg-12">
                        <div class="col-lg-2">
                            <select name="month" id="month" class="form-select form-select-md select-2">
                                <option value="0">Desember</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <select name="years" id="years" class="form-select form-select-md select-2">
                                <option value="0">2020</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-sm btn-primary input-group-text" type="button"><i
                                    class="lab la-searchengin"></i></button>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex justify-content-end">
                                <div class="card col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total </p>
                                                    <h6 class="font-weight-bolder">
                                                        Rp. 14.000.000.000
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                    <i class="ni ni-paper-diploma text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchtableAsset" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100"
                            id="tableAsset">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Asset
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        Keterangan
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal
                                        Pembelian</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tahun
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Bulan
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal
                                        Akhir</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        Depresiasi Perbulan</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Akumulasi
                                        Depresiasi 2021</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Total
                                        Depresiasi</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Book
                                        Value</th>
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
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
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
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
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
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableAsset').focus();

        }

        var tableAsset = $('#tableAsset').DataTable({
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

        $('#searchtableAsset').keyup(function() {
            tableAsset.search($(this).val()).draw()
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
                            tableAsset.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
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
