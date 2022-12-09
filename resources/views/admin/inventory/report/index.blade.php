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
                            <h5 class="fw-bolder text-gray-600">Inventory Report</h5>
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
                    <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="tableStock">
                        <thead>
                            <tr
                                class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-top-2 border-gray-300 ">
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    rowspan="2">Code</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    rowspan="2">Items</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    rowspan="2">Partner</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    rowspan="2">Kemasan</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    rowspan="2">Box </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    colspan="2">Start Stock</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    colspan="4">Received</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    colspan="4">Delivery Order </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    colspan="2">End Stock</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7"
                                    rowspan="2">Option</th>
                            </tr>
                            <tr
                                class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-gray-300">
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur
                                    Lt/Kg</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur Box
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur
                                    Lt/Kg</th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur Box
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg
                                </th>
                                <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
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
