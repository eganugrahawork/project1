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
                       <h5>Item Qty</h5>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchItemQtyTable" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loading-add">
                        @can('edit', ['/admin/masterdata/itemqty'])
                        <button type="button" class="btn btn-primary me-3" onclick="addQtyModal()">
                        Add Price</button>
                        @endcan
                    </div>

                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="itemQtyTable">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-20px">No</th>
                            <th class="min-w-70px ">Item Code</th>
                            <th class="min-w-70px ">Item Name</th>
                            <th class="min-w-70px ">Partner Name</th>
                            <th class="min-w-70px ">Base Qty</th>
                            <th class="min-w-70px ">Unit Box</th>
                            <th class="min-w-70px ">Qty Receive</th>
                            <th class="min-w-70px ">Qty Discount</th>
                            <th class="min-w-70px ">Qty Bonus</th>
                            <th class="min-w-70px ">Status</th>

                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600" style="border:none;">
                        @foreach ($itemqty as $iq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $iq->item->item_code }}</td>
                                <td>{{ $iq->item->item_name }}</td>
                                <td>{{ $iq->item->partner->name }}</td>
                                <td>{{ $iq->base_qty }}</td>
                                <td>{{ $iq->unit_box }}</td>
                                <td>{{ $iq->qty_receive ? $iq->qty_receive : '0';}}</td>
                                <td>{{ $iq->qty_discount }}</td>
                                <td>{{ $iq->qty_bonus }}</td>
                                <td>{{ $iq->status }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
  var itemQtyTable = $('#itemQtyTable').DataTable();

$('#searchItemQtyTable').keyup(function() {
            itemQtyTable.search($(this).val()).draw()
        });
</script>

@endsection
