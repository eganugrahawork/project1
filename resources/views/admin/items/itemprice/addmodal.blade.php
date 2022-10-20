<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/itemprice/store" method="post">
    @csrf
    <div class="row">
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Items</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="item_id" name="item_id" required>
                    <option>Pilih Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->item_code }}-{{ $item->item_name }}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Unit Of Measure</label>
                <input type="text" id="uom" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Partner</label>
                <input type="text" id="partner" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Buy Price</label>
                <input type="number" name="buy_price" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Base Price</label>
                <input type="number" name="base_price" class="form-control form-control-solid mb-3 mb-lg-0" />
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Bottom Price</label>
                <input type="number" name="bottom_price" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Top Price</label>
                <input type="number" name="top_price" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Price Pcs</label>
                <input type="number" name="price_pcs" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
    </div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-add">Add Price</button>
        </div>
</form>
<script>
    $('form').submit(function(){
    $('#btn-add').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    })

    $('#item_id').on('change', function(){
        console.log()
        $.get("{{ url('/admin/masterdata/itemprice/getdetailitem') }}/"+$('#item_id').val(), {}, function(data){

                $('#uom').val(data.uom);
                $('#partner').val(data.partner);
            })
    })
</script>
