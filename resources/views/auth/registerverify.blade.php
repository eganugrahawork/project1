@extends('layouts.headerRegister')

@section('content')
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column" id="kt_create_account_stepper">
        <div class="d-flex flex-column flex-lg-row-auto w-xl-500px bg-lighten shadow-sm">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-500px scroll-y">
                <!--begin::Header-->
                <div class="d-flex flex-row-fluid flex-column flex-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="" class="mb-10 mb-lg-20">
                        <img alt="Logo" src="{{ asset('storage/logos/loccanalogo.png') }}" class="h-40px" />
                    </a>
                    <div class="stepper-nav">
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">1</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Account Details</h3>
                                <div class="stepper-desc fw-bold">Your Account Details</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Make a Password</h3>
                                <div class="stepper-desc fw-bold">Complete Registration</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-150px min-h-lg-300px" style="background-image: url(assets/media/illustrations/sketchy-1/16.png"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-700px p-10 p-lg-15 mx-auto">
                    <form class="my-auto pb-5" method="POST" action="/register/update" id="kt_create_account_form">
                        <div class="current" data-kt-stepper-element="content">
                            @csrf
                            <div class="w-100">
                                <div class="pb-10 pb-lg-15">
                                    <h2 class="fw-bolder d-flex align-items-center text-dark">Choose Account Type
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i></h2>
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a href="#" class="link-primary fw-bolder">Help Page</a>.</div>
                                </div>
                                <div class="fv-row">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12">
                                            <!--begin::Option-->
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <input type="hidden" name="email" value="{{ $user->email }}">
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_personal">
                                                <span class="svg-icon svg-icon-3x me-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-4 mb-2">Your Username</span>
                                                    <span class="text-muted fw-bold fs-6">{{ $user->username }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="" data-kt-stepper-element="content">
                            <div class="w-100">
                                <div class="pb-10 pb-lg-12">
                                    <h2 class="fw-bolder text-dark">Set Your Password</h2>
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a  class="link-primary fw-bolder">Help Page</a>.</div>
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required">Password</label>
                                    <input name="password" id="password" class="form-control form-control-lg form-control-solid" type="password" required/>
                                    <span id="minpass"></span>

                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required">Repeat Password</label>
                                    <input name="confirm_password" id="confirm_password" class="form-control form-control-lg form-control-solid" type="password" required/>
                                    <span id='message'></span>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex flex-stack pt-15">
                            <div class="mr-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                        <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
                                    </svg>
                                </span>Previous</button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary" id="btn-submitnya" data-kt-stepper-action="submit">
                                    <span class="indicator-label">Submit
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-4 ms-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                                <span class="svg-icon svg-icon-4 ms-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                    </svg>
                                </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <div class="d-flex flex-center fw-bold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                    <a href="https://keenthemes.com/support" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                    <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $('#btn-submitnya').prop('disabled', true);
    $('#confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
            $('#btn-submitnya').prop("disabled", false);
        } else{

            $('#message').html('Not Matching').css('color', 'red');
            $('#btn-submitnya').prop('disabled', true);
        }

    });

var minLength = 8;

$("#password").on("keydown keyup change", function(){
    var value = $(this).val();
    if (value.length < minLength){
        $("#minpass").text("Text is short");
    }
    else{
        $("#minpass").text("Text is valid");
    }
});
</script>
@endsection

