<form id="kt_modal_add_user_form" class="form" >
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Po Number</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="po_number" required>
                        <option>Choose Po Number</option>
                    </select>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Po Code</label>
                <input type="text" id="code" name="code" readonly class="form-control form-control-white mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Date</label>
                <input type="text" name="order_date" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Partners</label>
                <input type="text" name="partner" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Address</label>
                <textarea type="text" name="address" id="address" readonly class="form-control form-control-solid mb-3 mb-lg-0"  ></textarea>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Phone Number</label>
                <input type="text" name="phone" id="phone" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Fax</label>
                <input type="text" name="fax" id="fax" readonly class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Number Delivery Order</label>
                <input type="number" name="do_number" id="do_number" value="11" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Received Date</label>
                <input type="datetime-local" name="do_date" id="do_date"  class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Plate Number</label>
                <input type="date" name="plate_number" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Status</label>
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option value="1">Yes</option>
                        <option value="0">Not</option>
                    </select>
            </div>
        </div>
        <div class="col-lg-12"id="itemsAddList">
            <h1>Items</h1>
            <hr>
        <div class="row" >
            <div class="fv-row mb-7 col-lg-3">
                <label class="required form-label fw-bold">Item</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="item_id" name="item_id[]" onchange="getBaseQty(this)" required>
                        <option>Choose Partner First</option>
                </select>
            </div>
            <div class="fv-row mb-7 col-lg-3">
                <label class="required fw-bold fs-6 mb-2">Mutation</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="mutation_id" name="mutation_id[]" onchange="getBaseQty(this)" required>
                    <option>Choose Mutation First</option>
            </select>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Order Qty</label>
                <input type="number" name="qty_order[]" id="qty_order" value="0" class="form-control form-control-solid mb-3 mb-lg-0 "  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Received</label>
                <input type="number" name="qty[]" id="qty" value="0" class="form-control form-control-solid mb-3 mb-lg-0 "  required/>
            </div>
            <div class="fv-row mb-7 col-lg-1">
                <label class="required fw-bold fs-6 mb-2">Bonus</label>
                <input type="number" name="qty_bonus[]" id="qty_bonus" value="0" class="form-control form-control-solid mb-3 mb-lg-0 " required/>
            </div>
            <div class="fv-row mb-7 col-lg-3">
                <label class="required fw-bold fs-6 mb-2">Note</label>
                <input type="text" name="description[]" id="description" class="form-control form-control-solid mb-3 mb-lg-0 descriptionnya"  required/>
            </div>
        </div>
        </div>
    </div>
    <hr>

        <div class="d-flex justify-content-end" id="loadingnya">
            <div class="px-2">
                <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Confirm</button>
            </div>
            <div class="px-2">
                <button class="btn btn-sm btn-success" onclick="tutupModal()" id="btn-add">Cancel</button>
            </div>
        </div>
</form>

