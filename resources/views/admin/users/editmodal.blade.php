<form id="kt_modal_add_user_form" class="form" action="/admin/users/update" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <input type="hidden" name="id_detail_user" value="{{ $user->id_detail_user }}">
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
        <div class="fv-row mb-7">
            <label class="d-block fw-bold fs-6 mb-5">Image</label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ URL::asset('storage/'.$user->userdetail->image) }});"></div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
            </div>
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Nama</label>
            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $user->userdetail->nama }}" required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Email</label>
            <input type="email" name="email" oninput="checkEmail(this)" value="{{ $user->email }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            <div class="form-text" style="color: red" id="edemailmin"><i class="bi bi-x-circle-fill"></i> Harus Email</div>
            <div class="form-text" style="color: rgb(207, 207, 29)" id="edemailcheck"><i class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
            <div class="form-text" style="color: red" id="edemailcheckfalse"><i class="bi bi-x-circle-fill"></i> Email sudah ada</div>
            <div class="form-text" style="color: rgb(61, 32, 187)" id="edemailchecktrue"><i class="bi bi-check2-circle"></i> Email Bisa Digunakan</div>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">No. Telp</label>
            <input type="number" name="nokontak" value="{{ $user->userdetail->nokontak }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Alamat</label>
            <input type="text" name="alamat" value="{{ $user->userdetail->alamat }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Wilayah</label>
            <select class="form-select form-select-solid" name="lokasi" required>
                @foreach ( $lokasi as $l )
                <option value="{{ $l->lokasi }}" @if ($user->userdetail->lokasi === $l->lokasi)
                    selected
                @endif>{{ $l->lokasi }}</option>
                @endforeach
            </select>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Username</label>
            <input type="text" name="username" value="{{ $user->username }}" oninput="checkUsername(this)"  class="form-control form-control-solid mb-3 mb-lg-0"  required/>
            <div class="form-text" style="color: red" id="edusrmin"><i class="bi bi-x-circle-fill"></i> Minimal 4 Karakter</div>
            <div class="form-text" style="color: rgb(207, 207, 29)" id="edusrcheck"><i class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
            <div class="form-text" style="color: red" id="edusrcheckfalse"><i class="bi bi-x-circle-fill"></i> Username sudah ada</div>
            <div class="form-text" style="color: rgb(61, 32, 187)" id="edusrchecktrue"><i class="bi bi-check2-circle"></i> Bisa Digunakan</div>

        </div>
        <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">New Password</label>
            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0"  />
        </div>
        <div class="mb-7">
            <label class="required fw-bold fs-6 mb-5">Role</label>
            @foreach ($role as $r )
            <div class="d-flex fv-row">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input me-3" name="id_role" type="radio" value="{{ $r->id }}" id="kt_modal_update_role_option_0" @if ($r->id == $user->id_role)
                    checked='checked'
                    @endif  />
                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                        <div class="fw-bolder text-gray-800">{{ $r->role }}</div>
                    </label>
                </div>
            </div>
            <div class='separator separator-dashed my-5'></div>
            @endforeach
        </div>
    </div>
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" onclick="tutupmodalnyah()">Discard</button>
        <button type="submit" class="btn btn-primary" id="submitbuttonnya" data-kt-users-modal-action="submit">Submit</button>
        <button type="button" class="btn btn-primary" data-kt-users-modal-action="submit" hidden>
            <span class="indicator-label">Submit</span>
            <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>


<script>
    $("#edusrmin").hide()
    $("#edusrcheck").hide()
    $("#edusrcheckfalse").hide()
    $("#edusrchecktrue").hide()
    $("#edemailmin").hide()
    $("#edemailcheck").hide()
    $("#edemailcheckfalse").hide()
    $("#edemailchecktrue").hide()

    function tutupmodalnyah(){
        $('#mainmodal').modal('toggle')
    }
</script>

<script src="/metronic/assets/js/custom/apps/user-management/users/list/add.js"></script>
