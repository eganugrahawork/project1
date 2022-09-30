<form id="kt_modal_add_user_form" class="form" action="/admin/configuration/submenu/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $submenu->id }}">
    <label class="form-label fw-bold">Submenu</label>
    <input type="text" name="submenu" value="{{ $submenu->submenu }}" class="form-control" required>
    <div>
        <label class="form-label fw-bold">Menu</label>
    <select class="form-select" name="id_menu">
        @foreach ($menu as $m)
            <option value="{{ $m->id }}" @if ($m->id == $submenu->id_menu)
                selected
            @endif>{{ $m->menu }}</option>
        @endforeach
    </select>
    </div>
    <div>
        <label class="form-label fw-bold">Icon</label>
        <input type="text" class="form-control"value="{{ $submenu->icon }}" name="icon" required>
    </div>
    <div>
        <label class="form-label fw-bold">Url</label>
        <input type="text" class="form-control" value="{{ $submenu->urlsubmenu }}" name="urlsubmenu" required>
    </div>

    <div class="d-flex justify-content-end mt-2">
        <button class="btn btn-sm btn-primary">Update</button>
    </div>

</form>
