<form id="kt_modal_add_user_form" class="form" action="/admin/configuration/userrole/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $role->id }}">
    <label class="form-label fw-bold">Role</label>
    <input type="text" name="role" value="{{ $role->role }}" class="form-control" required>
    <div class="d-flex justify-content-end mt-2">
        <button class="btn btn-sm btn-primary">Update</button>
    </div>

</form>
