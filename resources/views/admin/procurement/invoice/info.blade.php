<div class="card">
    <div class="card-header">
        <h4>Detail Invoice</h4>
    </div>
    <div class="card-body">
        <form id="addInvoice" class="form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <input type="hidden" name="id_receipt" id="id_receipt">
                        <label class="required form-label fw-bold">Nomor Delivery Order</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="purchase_order_id"
                            id="purchase_order_id" required>
                            <option value="">{{ $data[0]->do_number }}-{{ $data[0]->name }}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">No Purchase Order</label>
                        <input type="text" id="code" name="code" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->no_po }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal Purchase Order</label>
                        <input type="text" name="order_date" id="order_date" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->order_date }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class=" form-label fw-bold">Partner</label>
                        <input type="text" name="partner" id="partner" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->name }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-transparent mb-3 mb-lg-0">{{ $data[0]->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ $data[0]->phone }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" id="fax" value="{{ $data[0]->fax }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <input type="text" id="term_of_payment" name="term_of_payment"
                            class="form-control form-control-transparent mb-3 mb-lg-0"
                            value="{{ $data[0]->term_of_payment }}" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control form-control-transparent mb-3 mb-lg-0" readonly required>{{ $data[0]->description }}</textarea>

                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Kirim Ke</label>
                        <textarea id="shipment" class="form-control form-control-transparent mb-3 mb-lg-0" readonly required>{{ $data[0]->shipment }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                        <input type="text" id="vat" value="{{ $data[0]->ppn }}"
                            class="form-control form-control-transparent mb-3 mb-lg-0" readonly required />
                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="text" id="email" class="form-control form-control-transparent mb-3 mb-lg-0"
                            value="-" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Telp/Fax</label>
                        <input type="text" id="telp/fax" class="form-control form-control-transparent mb-3 mb-lg-0"
                            value="0837263723" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">No Invoice</label>
                        <input type="text" name="no_invoice" id="no_invoice"
                            class="form-control form-control-transparent mb-3 mb-lg-0"
                            value="{{ $data[0]->invoice_number }}" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tanggal Invoice</label>
                        <div class="">
                            <input type="text" name="date_invoice" id="date_invoice"
                                class="form-control form-control-transparent mb-3 mb-lg-0"
                                value="{{ $data[0]->invoice_date }}" readonly required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Jatuh Tempo</label>
                        <div class="">
                            <input type="text" name="due_date" id="due_date"
                                class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->due_date }}"
                                readonly required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Att</label>
                        <input type="text" name="att" id="att" value="{{ $data[0]->attention }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskirpsi Invoice</label>
                        <textarea name="description_invoice" id="description_invoice" class="form-control form-control-transparent mb-3 mb-lg-0"
                            readonly required>{{ $data[0]->description }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Tax Invoice</label>
                        <input type="text" name="tax_invoice" id="tax_invoice"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->tax_invoice }}"
                            readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Sign</label>
                        <input type="text" name="sign" id="sign"
                            class="form-control form-control-transparent mb-3 mb-lg-0" value="{{ $data[0]->sign }}"
                            readonly required />
                    </div>

                </div>
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12"id="itemsList">
                    @foreach ($data as $item)
                        <div class='row'>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' form-label fw-bold'>Item</label>
                                <select class='form-select  form-select-transparent mb-3 mb-lg-0' id='item_id'
                                    name='item_id[]' required>
                                    <option value='{{ $item->item_id }}'>{{ $item->item_name }}</option>
                                </select>
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Qty Diterima</label>
                                <input type='number' name='qty_receipt[]' id='qty_receipt'
                                    value='{{ $item->qty_receipt }}' readonly
                                    class='form-control form-control-transparent mb-3 mb-lg-0 ' required />
                            </div>

                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Harga Unit</label>
                                <input type='number' name='unit_price[]' id='unit_price'
                                    value='{{ $item->unit_price }}' readonly
                                    class='form-control form-control-transparent mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Diskon</label>
                                <input type='number' name='qty_discount[]' id='qty_discount'
                                    value='{{ $item->discount }}' readonly
                                    class='form-control form-control-transparent mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Total Harga</label>
                                <input type='number' name='price[]' id='price' value='{{ $item->price }}'
                                    readonly class='form-control form-control-transparent mb-3 mb-lg-0 ' required />
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-center" id="loadingnya">

                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" onclick="tutupContent()" id="btn-add">Kembali</button>
                </div>
            </div>
        </form>
    </div>
</div>
