<div class="row">
    <div class="col-lg-4">
        <div class="card card-bordered mb-5 bg-warna text-gray-200">
            <div class="card-header">
                <h3 class="card-title text-white text-center">{{ $partner->name }}</h3>
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
                <h3 class="card-title text-white text-center">Total Selling</h3>
            </div>
            <div class="card-body">
                <h2 class="text-white">Rp. 20.000.000.000</h2>
            </div>
            <div class="card-footer bg-light">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar2-week"></i></span>
                    <input type="text" class="form-control form-control-flush text-gray-600 daterange-selling"  name="daterange" value="2022-01-01 - 2022-11-31" style="font-size: 11px;">
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
                    <input type="text" class="form-control form-control-flush text-gray-600 daterange-order"  name="daterange" value="2022-01-01 - 2022-11-31" style="font-size: 11px;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="">

            <h2>Items</h2>
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
