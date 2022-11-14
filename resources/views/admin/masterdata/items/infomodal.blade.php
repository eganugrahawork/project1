<div class="row">
    <div class="col-lg-4">
        <div class="card card-bordered mb-5 bg-warna text-gray-200">
            <div class="card-header">
                <h3 class="card-title text-white text-center">{{ $item->item_name }}</h3>
            </div>
            <div class="card-body">
                <p class="text-white">Code : {{ $item->item_code }}</p>
                <p>Type : {{ $item->type_id }}</p>
                <p>{{ $item->item_description }}</p>
                <p>Unit : {{ $item->uom->name }}</p>
                <p>Unit Box : {{ $item->itemqty->unit_box }}</p>
                <p>Vat : {{ $item->vat }}%</p>
            </div>
            <div class="card-footer">
                {{ $item->partner->name }}
            </div>
        </div>
        <div class="card card-bordered mb-5 bg-info">
            <div class="card-header">
                <h3 class="card-title text-white text-center">Total Selling</h3>
            </div>
            <div class="card-body">
                <h2 class="text-white">Rp. 20.000.000.000</h2>
            </div>
            <div class="card-footer bg-light">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar2-week"></i></span>
                    <input type="text" class="form-control form-control-flush text-gray-600 daterange-selling"
                        name="daterange" value="2022-01-01 - 2022-11-31" style="font-size: 11px;">
                </div>
            </div>
        </div>
        <div class="card card-bordered mb-5 bg-warning">
            <div class="card-header">
                <h3 class="card-title text-white text-center">Total Order</h3>
            </div>
            <div class="card-body">
                <h2 class="text-white">Rp. 20.000.000.000</h2>
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
        <div class="">

            <h2>Items Receipt History</h2>
            <hr>
            <table>
                <td>no</td>
                <td>Name item</td>
                <td>no</td>
                <td>no</td>
            </table>
        </div>
        <div class="">
            <h2>Invoice</h2>
            <hr>
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
