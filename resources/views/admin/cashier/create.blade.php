<div class="card">
    <div class="card-header">
        <h5 class="fw-bolder text-gray-600">Kasir</h5>
    </div>
    <div class="card-body py-0">
        <div id="cashierContent">
            <div class="col-lg-6 py-3">
                <div class="row">
                    <div class="col-lg-4">

                        <select name="transactiontype" id="transactiontype"
                            class="form-select form-select-solid select-2">
                            <option selected disabled>Pilih Jenis Transaksi</option>
                            <option value="sales">Penjualan</option>
                            <option value="buying">Pembelian</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-sm btn-primary">Pilih</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('.select-2').select2()
</script>
