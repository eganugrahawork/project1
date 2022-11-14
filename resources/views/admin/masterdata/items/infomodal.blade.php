<div class="row">
    <div class="col-lg-4">
        <div class="card card-bordered mb-5 bg-warna text-gray-400">
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
                <input type="text" class="form-control form-control-flush text-white" value="2022-01-01 - 2022-11-31">
                <hr>
                <h2 class="text-white">Rp. 20.000.000.000</h2>
            </div>
        </div>
        <div class="card card-bordered mb-5 bg-warning">
            <div class="card-header">
                <h3 class="card-title text-white text-center">Total Order</h3>
            </div>
            <div class="card-body">
                <input type="text" class="form-control form-control-flush text-white" value="2022-01-01 - 2022-11-31">
                <hr>
                <h2 class="text-white">Rp. 20.000.000.000</h2>
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
