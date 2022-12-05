<div class="card">
    <div class="card-header">
        <h4>Info {{ $partner->name }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" id='partner_id' value="{{ $partner->id }}">
            <div class="col-lg-4">
                <div class="card card-bordered mb-5 bg-warna text-gray-200">
                    <div class="card-header">
                        <h5 class="card-title fw-bolder text-white text-center">{{ $partner->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-white">Code : {{ $partner->code }}</p>
                        <p>Type : {{ $partner->partnertype->name }}</p>
                        <p>Phone :{{ $partner->phone }}</p>
                        <p>Fax : {{ $partner->fax }}</p>
                        <p>Email : {{ $partner->email }}</p>
                        <p>Address : {{ $partner->address }}</p>
                        <p>Ship Address : {{ $partner->ship_address }}</p>
                        <p>Bank : {{ $partner->bank_name }}</p>
                        <p>Account Number : {{ $partner->account_number }}</p>
                    </div>
                    <div class="card-footer">
                        {{ $partner->status }}
                    </div>
                </div>
                <div class="card card-bordered mb-5 bg-info">
                    <div class="card-header">
                        <h5 class="card-title fw-bolder text-white text-center">Sales</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="text-white fw-bolder">Rp. 20.000.000.000</h5>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar2-week"></i></span>
                            <input type="text"
                                class="form-control form-control-flush text-gray-600 daterange-selling" name="daterange"
                                value="2022-01-01 - 2022-11-31" style="font-size: 11px;">
                        </div>
                    </div>
                </div>
                <div class="card card-bordered mb-5 bg-warning">
                    <div class="card-header">
                        <h3 class="card-title fw-bolder text-white text-center">Total Order</h3>
                    </div>
                    <div class="card-body">
                        <h2 class="text-white fw-bolder">Rp. 20.000.000.000</h2>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar2-week"></i></span>
                            <input type="text" class="form-control form-control-flush text-gray-600 daterange-order"
                                name="daterange" value="2022-01-01 - 2022-11-31" style="font-size: 11px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h5>Items</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="itemTable">
                        <thead>
                            <tr class="fw-bolder fs-7 text-gray-600 text-uppercase">
                                <th>No</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Unit</th>
                                <th>Stock</th>
                                <th>Buy Price</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">

                        </tbody>
                    </table>
                </div>
                <div class="">
                    <h5>Invoice</h5>
                    <hr>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end pt-2">
            <button type="button" class="btn btn-sm btn-secondary" onclick="tutupContent()">Discard</button>
        </div>
    </div>
</div>

<script>
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $(".daterange-selling").val(start.format('YYYY-MM-DD') + " - " + end.format('YYYY-MM-DD'));
    }

    $(".daterange-selling").daterangepicker({
        static: true,
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
        },
        "drops": "up"
    }, cb);

    cb(start, end);

    function dds(start, end) {
        $(".daterange-order").val(start.format('YYYY-MM-DD') + " - " + end.format('YYYY-MM-DD'));
    }

    $(".daterange-order").daterangepicker({
        static: true,
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
        },
        "drops": "up"
    }, dds);

    dds(start, end);
</script>

<script>
    var partner_id = $('#partner_id').val();
    var itemTable = $('#itemTable').DataTable({
        pageLength: 5,
        serverside: true,
        processing: true,
        ajax: {
            url: "{{ url('/admin/masterdata/partners/getinfoitem') }}/" + partner_id
        },
        columns: [{
                data: 'DT_RowIndex',
                searchable: false
            },
            {
                data: 'item_code',
                name: 'item_code',
                className: "dt-nowrap"
            },
            {
                data: 'item_name',
                name: 'item_name'
            },
            {
                data: 'unit',
                name: 'unit'
            },
            {
                data: 'stock',
                name: 'stock',
                render: $.fn.dataTable.render.number('.', ',', 0, '')
            },
            {
                data: 'buy_price',
                name: 'buy_price',
                render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
            }
        ],
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false
    });
</script>
