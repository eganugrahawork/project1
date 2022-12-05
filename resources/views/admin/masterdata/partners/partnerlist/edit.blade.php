<div class="card">
    <div class="card-header">
        <h4>Edit {{ $partners->name }}</h4>
    </div>
    <div class="card-body">
        <form id="update-form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <input type="hidden" name="id" id="id" value="{{ $partners->id }}">
                        <label class="required fw-bold fs-6 mb-2">Code</label>
                        <input type="text" name="code" id="code"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $partners->code }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $partners->name }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $partners->email }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Partner Type</label>
                        <div class="col-lg-8">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="partner_type"
                                id="partner_type" required>
                                @foreach ($partner_type as $pt)
                                    <option value="{{ $pt->id }}"
                                        {{ $pt->id == $partners->partner_type ? 'selected' : '' }}>{{ $pt->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Phone Number</label>
                        <input type="number" name="phone" id="phone"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $partners->phone }}"
                            required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" name="fax" id="fax"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $partners->fax }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Address</label>
                        <textarea name="address" id="address" class="form-control form-control-solid mb-3 mb-lg-0" required>{{ $partners->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Ship address</label>
                        <textarea name="ship_address" id="ship_address" class="form-control form-control-solid mb-3 mb-lg-0" required>{{ $partners->ship_address }}</textarea>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Bank</label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" name="bank_name" id="bank_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="{{ $partners->bank_name }}" required />
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="account_number" id="account_number"
                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="{{ $partners->account_number }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-3 col-lg-6">
                        <label class="form-label fw-bold required">Status</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status"
                            required>
                            <option value="1" @if ($partners->status == 1) selected @endif>Ya</option>
                            <option value="0" @if ($partners->status !== 1) selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-update">Update Partner</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#update-form').on('submit', function(e) {
        e.preventDefault();

        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/partners/update') }}",
            data: $('#update-form').serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire(
                    'Success',
                    response.success,
                    'success'
                )
                $('#content').hide();
                $('#indexContent').show();
                partnerTable.ajax.reload(null, false);
            }
        })
    })
</script>
