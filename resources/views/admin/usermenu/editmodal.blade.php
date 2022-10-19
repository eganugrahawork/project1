    <form id="kt_modal_add_user_form" class="form" action="/admin/configuration/menu/update" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $menu->id }}">
            <div class="fv-row mb-7">
                <label class="form-label fw-bold">Parent</label>
                <select class="form-select form-select-solid mb-3 mb-lg-0" name="parent">
                    <option value="0" {{ $menu->parent == 0 ? 'selected' : '' }}>Main Parent</option>
                    @foreach ($allmenu as $m)
                        <option value="{{ $m->id }}" @if ($m->id == $menu->parent)
                            selected
                        @endif>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Name</label>
                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $menu->name }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Url</label>
                <input type="text" name="url" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $menu->url }}"/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Icon</label>
                <input type="text" name="icon" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $menu->icon }}"/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Sequence</label>
                <input type="number" name="sequence" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $menu->sequence }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold">Status</label>
                <select class="form-select form-select-solid mb-3 mb-lg-0" name="status">
                    <option value="0" {{ $menu->status == 0 ? 'selected' : '' }}>Hide</option>
                    <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Show</option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-primary">Update</button>
            </div>
</form>
