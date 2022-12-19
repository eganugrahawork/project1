<div class="card">
    <div class="card-header border-0">
        <div class="card-title align-items-start flex-column">
            <div class="d-flex align-items-center position-relative my-1">
                <h5 class="fw-bolder text-gray-600">Riwayat Pembayaran Piutang</h5>
            </div>
        </div>

        <div class="card-toolbar" id="loading-ah">
            @can('create', ['/admin/finance/receivable'])

                <button type="button" class="btn btn-sm btn-primary me-3" onclick="create()">
                    Tambah</button>
                <button type="button" class="btn btn-sm btn-success me-3" onclick="giroList()">
                    Daftar Giro</button>
                <button type="button" class="btn btn-sm btn-secondary me-3" onclick="tutupContent()">
                    Kembali</button>
            @endcan
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="row col-lg-7">
            <div class="col-lg-2">

                <select name="status" id="status" class="form-select form-select-md select-2">
                    <option value="0">Semua</option>
                    <option value="1">Lunas</option>
                    <option value="2">Belum Lunas</option>
                </select>
            </div>
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

        </div>
        <div class="d-flex justify-content-end position-relative my-1">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                    <input class="form-control" placeholder="Search" id="searchtableHistory" type="text">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="tableHistory">
                <thead>
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No Transaksi</th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Partner
                        </th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Total</th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal</th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tipe Akun</th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Status
                        </th>
                        <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-bold text-md text-gray-600" style="border:none;">

                </tbody>
            </table>
        </div>
    </div>
</div>

