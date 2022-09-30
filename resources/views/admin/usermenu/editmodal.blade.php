    <form id="kt_modal_add_user_form" class="form" action="/admin/configuration/menu/update" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $menu->id }}">
        <input type="hidden" name="is_submenu" value="{{ $menu->is_submenu }}">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Menu</label>
                <input type="text" name="menu" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $menu->menu }}" required/>
            </div>
            @if ($menu->is_submenu)

            @else
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Url</label>
                <input type="text" name="url" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $menu->url }}" required/>
            </div>
            @endif
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-primary">Update</button>
            </div>
</form>
