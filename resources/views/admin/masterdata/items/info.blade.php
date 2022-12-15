<div class="card">
    <div class="card-header">
        <h4>{{ $item->item_name }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" id="item_id" value="{{ $item->id }}">
            <div class="col-lg-4">
                <div class="card card-bordered mb-5 bg-warna text-gray-200">
                    <div class="card-header">
                        <h3 class="card-title text-white text-center">{{ $item->item_name }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-white">Kode Item : {{ $item->item_code }}</p>
                        <p>Tipe Item : {{ $item->type_id }}</p>
                        <p>{{ $item->item_description }}</p>
                        <p>Unit : {{ $item->uom->name }}</p>
                        <p>Unit Box : {{ $item->itemqty->unit_box }}</p>
                        <p>Pajak : {{ $item->vat }}%</p>
                    </div>
                    <div class="card-footer">
                        {{ $item->partner->name }}
                    </div>
                </div>
                <div class="card card-bordered mb-5 bg-primary">
                    <div class="card-header">
                        <h3 class="card-title text-white text-center">Stok</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="text-white">552</h5>
                    </div>
                </div>
                <div class="card card-bordered mb-5 bg-info">
                    <div class="card-header">
                        <h3 class="card-title text-white text-center">Total Penjualan</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="text-white">Rp. 20.000.000.000</h5>
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
                        <h3 class="card-title text-white text-center">Total Order</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="text-white">Rp. 20.000.000.000</h5>
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
                <h5>Histori Penerimaan Item</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="itemReceiptTable">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">No</th>
                                <th class="min-w-80px">No Pengiriman</th>
                                <th class="min-w-80px">Tanggal Diterima</th>
                                <th class="min-w-80px">Nomor PO</th>
                                <th class="min-w-80px">Tanggal Order</th>
                                <th class="min-w-80px">Qty</th>
                                <th class="min-w-100px">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">

                        </tbody>
                    </table>
                </div>
                <div class="">
                    <h5>Invoice</h5>
                    <hr>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end" id="loadingnya">
            <div class="py-2">
                <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
            </div>
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
        "drops": "auto"
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
        "drops": "auto"
    }, dds);

    dds(start, end);
</script>

<script>
    var item_id = $('#item_id').val();

</script>
