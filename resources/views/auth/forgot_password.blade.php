@extends('layouts.headerRegister', ['bgdark' => 'bg-dark'])

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Password reset -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url('/metronic/assets/media/illustrations/sketchy-1/14-dark.png')">

        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="/login" class="mb-12">
                <img alt="Logo" src="{{ asset('storage/logos/loccanalogo.png') }}" class="h-40px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" action="/forgot-password/sendemail" method="post">
                    <!--begin::Heading-->
                    @csrf
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Forgot Password ? </h1>
                        <!--end::Title-->
                        <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
                        <input class="form-control form-control-solid" type="email" placeholder="" id="email" name="email" autocomplete="off" />
                        <span id="checked" class="text-success">Email Available</span>
                        <span id="loadingnih" class="text-primary">Checking Email....</span>
                        <span id="non-checked" class="text-danger">Email Not Found!!</span>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <a href="/login" class="btn btn-lg btn-light-primary fw-bolder me-4">Cancel</a>
                        <button type="submit" id="submitbuttonnya" class="btn btn-lg btn-primary fw-bolder me-4">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <div class="d-flex align-items-center fw-bold fs-6">
                <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Password reset-->
</div>
@endsection
@section('js')
<script src="/metronic/assets/js/custom/authentication/password-reset/password-reset.js"></script>
<script>
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

    $("#checked").hide()
    $("#loadingnih").hide()
    $("#non-checked").hide()
    $("#submitbuttonnya").attr('disabled', true);


    $('#email').on('change', function(){
        let valuenya = $('#email').val();

        // let valuenya = e.value;
        let sendData = {
            'value' : valuenya
        };


        $("#loadingnih").show();
        var APP_URL = {!! json_encode(url('/forgot-password/checkemail')) !!}

        jQuery.ajax({
            type: "POST",
            url: APP_URL,
            data: sendData,
            cache: false,
            success: function(response) {
                    if (response.success == true) {
                        $("#non-checked").hide()
                        $("#checked").show()
                        $("#loadingnih").hide()
                        $("#submitbuttonnya").attr('disabled', false);
                    } else {
                        $("#checked").hide()
                        $("#non-checked").show()
                        $("#loadingnih").hide()
                        $("#submitbuttonnya").attr('disabled', true);
                    }
                }
            });

            }
    )
</script>
@endsection
