<div class="card">
    <div class="card-header">
        <h4>Edit {{ $user->name }}</h4>
    </div>
    <div class="card-body">
<form id="update-form" class="form">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <input type="hidden" name="oldimage" value="{{ $user->image }}">
    <input type="hidden" name="oldpassword" value="{{ $user->password }}">
    <div class="d-flex flex-column me-n7 pe-7">
        <div class="fv-row mb-7 text-center">
            <label class="d-block fw-bold fs-6 mb-5">Image</label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px"
                    style="background-image: url({{ URL::asset('storage/' . $user->image) }});"></div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
            </div>
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
        </div>
        <div class="row">
            <div class="col-lg-6">

                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Nama</label>
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                        value="{{ $user->name }}" required />
                </div>
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Email</label>
                    <input type="email" name="email" oninput="checkEmail(this)" value="{{ $user->email }}"
                        class="form-control form-control-solid mb-3 mb-lg-0" required />
                    <div class="form-text" style="color: red" id="edemailmin"><i class="bi bi-x-circle-fill"></i> Harus
                        Email</div>
                    <div class="form-text" style="color: rgb(207, 207, 29)" id="edemailcheck"><i
                            class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
                    <div class="form-text" style="color: red" id="edemailcheckfalse"><i class="bi bi-x-circle-fill"></i>
                        Email sudah ada</div>
                    <div class="form-text" style="color: rgb(61, 32, 187)" id="edemailchecktrue"><i
                            class="bi bi-check2-circle"></i> Email Bisa Digunakan</div>
                </div>
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">No. Telp</label>
                    <input type="number" name="no_hp" value="{{ $user->no_hp }}"
                        class="form-control form-control-solid mb-3 mb-lg-0" required />
                </div>
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Alamat</label>
                    <input type="text" name="address" value="{{ $user->address }}"
                        class="form-control form-control-solid mb-3 mb-lg-0" required />
                </div>
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Wilayah</label>
                    <select class="form-select form-select-solid select-2" name="region" required>
                        @foreach ($region as $l)
                            <option value="{{ $l->id }}" @if ($user->region === $l->id) selected @endif>
                                {{ $l->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Tempat Lahir</label>
                    <input type="text" name="place_of_birth" class="form-control form-control-solid mb-3 mb-lg-0"
                        value="{{ $user->place_of_birth }}" required />
                </div>
                <div class="fv-row mb-3">
                    <div>
                        <label class="required fw-bold fs-6 mb-2">Tanggal Lahir</label>
                    </div>
                    <input type="text" name="date_of_birth" id="date_of_birth"
                        class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $user->date_of_birth }}"
                        required />
                </div>
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Agama</label>
                    <select class="form-select form-select-solid select-2" name="religion" required>
                        <option value="Islam" @if ($user->religion == 'Islam') selected @endif>Islam</option>
                        <option value="Kristen" @if ($user->religion == 'Kristen') selected @endif>Kristen</option>
                        <option value="Protestan" @if ($user->religion == 'Protestan') selected @endif>Protestan</option>
                        <option value="Hindu" @if ($user->religion == 'Hindu') selected @endif>Hindu</option>
                        <option value="Budha" @if ($user->religion == 'Budha') selected @endif>Budha</option>
                        <option value="Ateis" @if ($user->religion == 'Ateis') selected @endif>Ateis</option>
                        <option value="Lainnya" @if ($user->religion == 'Lainnya') selected @endif>Lainnya</option>
                    </select>
                </div>
                <div class="fv-row mb-3">
                    <label class="required fw-bold fs-6 mb-2">Username</label>
                    <input type="text" name="username" value="{{ $user->username }}"
                        oninput="checkUsername(this)" class="form-control form-control-solid mb-3 mb-lg-0" required />
                    <div class="form-text" style="color: red" id="edusrmin"><i class="bi bi-x-circle-fill"></i>
                        Minimal 4 Karakter</div>
                    <div class="form-text" style="color: rgb(207, 207, 29)" id="edusrcheck"><i
                            class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
                    <div class="form-text" style="color: red" id="edusrcheckfalse"><i
                            class="bi bi-x-circle-fill"></i> Username sudah ada</div>
                    <div class="form-text" style="color: rgb(61, 32, 187)" id="edusrchecktrue"><i
                            class="bi bi-check2-circle"></i> Bisa Digunakan</div>

                </div>
                <div class="fv-row mb-3">
                    <label class="fw-bold fs-6 mb-2">New Password</label>
                    <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" />
                </div>
                <div class="mb-7">
                    <label class="required fw-bold fs-6 mb-5">Role</label>
                    @foreach ($role as $r)
                        <div class="d-flex fv-row">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input me-3" name="role_id" type="radio"
                                    value="{{ $r->id }}" id="kt_modal_update_role_option_0"
                                    @if ($r->id == $user->role_id) checked='checked' @endif />
                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <div class="fw-bolder text-gray-800">{{ $r->role }}</div>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="text-center pt-15" id="loadingButtonHere">
        <button type="reset" class="btn btn-light me-3" onclick="tutupContent()">Discard</button>
        <button type="submit" class="btn btn-primary" id="submitbuttonnya"
            data-kt-users-modal-action="submit">Submit</button>
        <button type="button" class="btn btn-primary" data-kt-users-modal-action="submit" hidden>
            <span class="indicator-label">Update</span>
            <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>
    </div>
</div>


<script>
    flatpickr("#date_of_birth", {
        static:true,
        dateFormat: "Y-m-d",
    });

    $("#edusrmin").hide()
    $("#edusrcheck").hide()
    $("#edusrcheckfalse").hide()
    $("#edusrchecktrue").hide()
    $("#edemailmin").hide()
    $("#edemailcheck").hide()
    $("#edemailcheckfalse").hide()
    $("#edemailchecktrue").hide()



    $('#update-form').on('submit', function(e) {
        e.preventDefault()
        $('#loadingButtonHere').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
        var data = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{ url('/admin/users/update') }}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire(
                    'Success',
                    response.success,
                    'success'
                )
                $('#content').hide();
                $('#indexContent').show()
                usersTable.ajax.reload(null, false);
            }
        });

    });
</script>

<script>
    var KTImageInput = function(e, t) {
        var n = this;
        if (null != e) {
            var i = {},
                r = function() {
                    n.options = KTUtil.deepExtend({}, i, t), n.uid = KTUtil.getUniqueId("image-input"), n.element =
                        e, n.inputElement = KTUtil.find(e, 'input[type="file"]'), n.wrapperElement = KTUtil.find(e,
                            ".image-input-wrapper"), n.cancelElement = KTUtil.find(e,
                            '[data-kt-image-input-action="cancel"]'), n.removeElement = KTUtil.find(e,
                            '[data-kt-image-input-action="remove"]'), n.hiddenElement = KTUtil.find(e,
                            'input[type="hidden"]'), n.src = KTUtil.css(n.wrapperElement, "backgroundImage"), n
                        .element.setAttribute("data-kt-image-input", "true"), o(), KTUtil.data(n.element).set(
                            "image-input", n)
                },
                o = function() {
                    KTUtil.addEvent(n.inputElement, "change", a), KTUtil.addEvent(n.cancelElement, "click", l),
                        KTUtil.addEvent(n.removeElement, "click", s)
                },
                a = function(e) {
                    if (e.preventDefault(), null !== n.inputElement && n.inputElement.files && n.inputElement.files[
                            0]) {
                        if (!1 === KTEventHandler.trigger(n.element, "kt.imageinput.change", n)) return;
                        var t = new FileReader;
                        t.onload = function(e) {
                                KTUtil.css(n.wrapperElement, "background-image", "url(" + e.target.result + ")")
                            }, t.readAsDataURL(n.inputElement.files[0]), KTUtil.addClass(n.element,
                                "image-input-changed"), KTUtil.removeClass(n.element, "image-input-empty"),
                            KTEventHandler.trigger(n.element, "kt.imageinput.changed", n)
                    }
                },
                l = function(e) {
                    e.preventDefault(), !1 !== KTEventHandler.trigger(n.element, "kt.imageinput.cancel", n) && (
                        KTUtil.removeClass(n.element, "image-input-changed"), KTUtil.removeClass(n.element,
                            "image-input-empty"), KTUtil.css(n.wrapperElement, "background-image", n.src), n
                        .inputElement.value = "", null !== n.hiddenElement && (n.hiddenElement.value = "0"),
                        KTEventHandler.trigger(n.element, "kt.imageinput.canceled", n))
                },
                s = function(e) {
                    e.preventDefault(), !1 !== KTEventHandler.trigger(n.element, "kt.imageinput.remove", n) && (
                        KTUtil.removeClass(n.element, "image-input-changed"), KTUtil.addClass(n.element,
                            "image-input-empty"), KTUtil.css(n.wrapperElement, "background-image", "none"), n
                        .inputElement.value = "", null !== n.hiddenElement && (n.hiddenElement.value = "1"),
                        KTEventHandler.trigger(n.element, "kt.imageinput.removed", n))
                };
            !0 === KTUtil.data(e).has("image-input") ? n = KTUtil.data(e).get("image-input") : r(), n
                .getInputElement = function() {
                    return n.inputElement
                }, n.goElement = function() {
                    return n.element
                }, n.destroy = function() {
                    KTUtil.data(n.element).remove("image-input")
                }, n.on = function(e, t) {
                    return KTEventHandler.on(n.element, e, t)
                }, n.one = function(e, t) {
                    return KTEventHandler.one(n.element, e, t)
                }, n.off = function(e) {
                    return KTEventHandler.off(n.element, e)
                }, n.trigger = function(e, t) {
                    return KTEventHandler.trigger(n.element, e, t, n, t)
                }
        }
    };
    KTImageInput.getInstance = function(e) {
            return null !== e && KTUtil.data(e).has("image-input") ? KTUtil.data(e).get("image-input") : null
        }, KTImageInput.createInstances = function(e = "[data-kt-image-input]") {
            var t = document.querySelectorAll(e);
            if (t && t.length > 0)
                for (var n = 0, i = t.length; n < i; n++) new KTImageInput(t[n])
        }, KTImageInput.init = function() {
            KTImageInput.createInstances()
        }, "loading" === document.readyState ? document.addEventListener("DOMContentLoaded", KTImageInput.init) :
        KTImageInput.init(), "undefined" != typeof module && void 0 !== module.exports && (module.exports =
            KTImageInput);
</script>
