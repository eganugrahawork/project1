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
                       <h5>Harga Item</h5>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchItemPrice" type="text">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body pt-0">
                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="itemPrice">
                    <thead>
                        <tr >
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Kode Item</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Nama Item</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Partner</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Price Atas</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Price Dasar</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Price Bawah</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-md fw-bold" style="border:none;">
                        @foreach ($itemprice as $ip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ip->item->item_code }}</td>
                                <td>{{ $ip->item->item_name }}</td>
                                <td>{{ $ip->item->partner->name }}</td>
                                <td>{{ $ip->top_price }}</td>
                                <td>{{ $ip->base_price }}</td>
                                <td>{{ $ip->bottom_price }}</td>
                                <td>{{ $ip->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>


@endsection

@section('js')

<script>
    var itemPriceTable = $('#itemPrice').DataTable();

$('#searchItemPrice').keyup(function() {
            itemPriceTable.search($(this).val()).draw()
        });
</script>

@endsection
