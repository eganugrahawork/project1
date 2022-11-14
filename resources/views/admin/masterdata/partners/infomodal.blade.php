<div class="row">
    <div class="col-lg-4">
        <div class="card card-bordered mb-5 bg-warna text-gray-400">
            <div class="card-header">
                <h3 class="card-title text-white text-center">{{ $partner->name }}</h3>
            </div>
            <div class="card-body">
                <p class="text-white">Code : {{ $partner->code }}</p>
                <p>Type : {{ $partner->partner_type }}</p>
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
