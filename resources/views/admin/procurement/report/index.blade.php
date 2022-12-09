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
                            <h5 class="fw-bolder text-gray-600">Procurement Report</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex col-lg-12">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <select name="partner_id" id="partner_id" class="form-select form-select-md select-2">
                                        <option value="0">All</option>
                                        @foreach ($partner as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" id="daterange" name="daterange"
                                                class="form-control form-control-md text-gray-500" />
                                        </div>
                                        <div class="col-lg-2">
                                            <a class="btn btn-sm btn-primary input-group-text" onclick="getTable()"><i
                                                    class="lab la-searchengin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="d-flex align-items-center position-relative justify-content-end  my-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        <input class="form-control" placeholder="Search" id="searchtableReport"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableReport">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Date
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Item Code
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Item
                                    Name</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Kemasan</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Qty</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Price</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Total Price
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Vat</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Rp.PPN</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No Trans</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No Invoice
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Due Date</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lama Hari
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No Faktur
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal
                                    Faktur Pajak</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-md text-gray-600" style="border:none;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
    </script>
    <script>
        $('.select-2').select2();
        var statusTable = false;


        function getTable() {
            var tableReport;
            partner_id = $('#partner_id').val();
            daterange = $('#daterange').val();
            if (statusTable == true) {
                $('#tableReport').DataTable().destroy();
            }
             tableReport = $('#tableReport').DataTable({
                serverside: true,
                processing: true,
                bDestroy: true,
                ajax: {
                    url: "{{ url('/admin/procurement/report/list') }}/" + partner_id + "/" + daterange
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'date_po',
                        name: 'date_po'
                    },
                    {
                        data: 'item_code',
                        name: 'item_code'
                    },
                    {
                        data: 'item_name',
                        name: 'item_name'
                    },
                    {
                        data: 'kemasan',
                        name: 'kemasan'
                    },
                    {
                        data: 'qty_receipt',
                        name: 'qty_receipt'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'ppn',
                        name: 'ppn'
                    },
                    {
                        data: 'Rp_PPN',
                        name: 'Rp_PPN',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'No_trans',
                        name: 'No_trans'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date'
                    },
                    {
                        data: 'lama_hari',
                        name: 'lama_hari'
                    },
                    {
                        data: 'tax_invoice',
                        name: 'tax_invoice'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date'
                    }
                ],
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false
            });
            $('#searchtableReport').keyup(function() {
                tableReport.search($(this).val()).draw()
            });
            statusTable = true;
        }
    </script>
@endsection
