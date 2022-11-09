@extends('layouts.headerRegister')

@section('content')
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column" id="kt_create_account_stepper">
        <div class="d-flex flex-column flex-lg-row-auto w-xl-500px bg-lighten shadow-sm">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-500px scroll-y">
                <!--begin::Header-->
                <div class="d-flex flex-column flex-center p-10 pt-lg-10">
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
                                <h3 class="stepper-title">Account Type</h3>
                                <div class="stepper-desc fw-bold">Setup Your Account Details</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">3</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Account Profile</h3>
                                <div class="stepper-desc fw-bold">Your Profile Related Info</div>
                            </div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-line w-40px"></div>
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">4</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Confirmation Register</h3>
                                <div class="stepper-desc fw-bold">End Registration Section</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-75px min-h-lg-75px" style="background-image: url({{ asset('storage/logos/register.png') }})"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-700px p-10 p-lg-15 mx-auto">
                    <form class="my-auto pb-5" method="POST" action="/register/create" id="kt_create_account_form">
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
                                        <div class="col-lg-6">
                                            <!--begin::Option-->
                                            <input type="radio" class="btn-check" name="type_account_id" value="1" checked="checked" id="kt_create_account_form_account_type_personal" />
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_personal">
                                                <span class="svg-icon svg-icon-3x me-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-4 mb-2">Personal Account</span>
                                                    <span class="text-muted fw-bold fs-6">If you need more info, please check it out</span>
                                                </span>
                                                <!--end::Info-->
                                            </label>
                                            <!--end::Option-->
                                        </div>

                                        <div class="col-lg-6">
                                            <!--begin::Option-->
                                            <input type="radio" class="btn-check" name="type_account_id" value="2" id="kt_create_account_form_account_type_corporate" />
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center" for="kt_create_account_form_account_type_corporate">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-3x me-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                                                        <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                                                    </svg>
                                                </span>

                                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-4 mb-2">Corporate Account</span>
                                                    <span class="text-muted fw-bold fs-6">Create corporate account to mane users</span>
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
                                    <h2 class="fw-bolder text-dark">Profile Details</h2>
                                    <div class="text-muted fw-bold fs-6">If you need more info, please check out
                                    <a  class="link-primary fw-bolder">Help Page</a>.</div>
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required">Full Name</label>
                                    <input name="name" class="form-control form-control-lg form-control-solid" placeholder="Type your full name" required/>
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Address</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="&lt;div class='p-4 rounded bg-light'&gt; &lt;div class='d-flex flex-stack text-muted mb-4'&gt; &lt;i class='fas fa-university fs-3 me-3'&gt;&lt;/i&gt; &lt;div class='fw-bold'&gt;INCBANK **** 1245 STATEMENT&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack fw-bold text-gray-600'&gt; &lt;div&gt;Amount&lt;/div&gt; &lt;div&gt;Transaction&lt;/div&gt; &lt;/div&gt; &lt;div class='separator separator-dashed my-2'&gt;&lt;/div&gt; &lt;div class='d-flex flex-stack text-dark fw-bolder mb-2'&gt; &lt;div&gt;USD345.00&lt;/div&gt; &lt;div&gt;KEENTHEMES*&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted mb-2'&gt; &lt;div&gt;USD75.00&lt;/div&gt; &lt;div&gt;Hosting fee&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted'&gt; &lt;div&gt;USD3,950.00&lt;/div&gt; &lt;div&gt;Payrol&lt;/div&gt; &lt;/div&gt; &lt;/div&gt;"></i>
                                    </label>
                                    <textarea name="address" class="form-control form-control-lg form-control-solid" placeholder="Type your address" rows="3" required></textarea>
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="fs-6 fw-bold form-label required">Contact Email</label>
                                    <input name="email" oninput="checkEmail(this)" type="email" class="form-control form-control-lg form-control-solid" required placeholder="Type your email"/>
                                    <div class="form-text" style="color: red" id="demailmin"><i class="bi bi-x-circle-fill"></i> Harus Email</div>
                                    <div class="form-text" style="color: rgb(207, 207, 29)" id="demailcheck"><i class="bi bi-arrow-clockwise"></i> Sedang Memeriksa</div>
                                    <div class="form-text" style="color: red" id="demailcheckfalse"><i class="bi bi-x-circle-fill"></i> Email sudah ada</div>
                                    <div class="form-text" style="color: rgb(61, 32, 187)" id="demailchecktrue"><i class="bi bi-check2-circle"></i> Email Bisa Digunakan</div>
                                </div>
                                <div class="fv-row mb-0">
                                    <label class="fs-6 fw-bold form-label required">Phone Contact</label>
                                    <input name="no_hp" type="number" class="form-control form-control-lg form-control-solid" required placeholder="Type your phone number"/>
                                </div>
                            </div>
                        </div>
                        <div class="" data-kt-stepper-element="content">
                            <div class="w-100">
                                <div class="pb-8 pb-lg-10">
                                    <h2 class="fw-bolder text-dark">Your Are Done!</h2>
                                    <div class="text-muted fw-bold fs-6">If you need more info, please
                                    <a href="../../demo11/dist/authentication/sign-in/basic.html" class="link-primary fw-bolder">Sign In</a>.</div>
                                </div>
                                <div class="mb-0">
                                    <div class="fs-6 text-gray-600 mb-5">Writing headlines for blog posts is as much an art as it is a science and probably warrants its own post, but for all advise is with what works for your great &amp; amazing audience.</div>
                                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                                            </svg>
                                        </span>
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <div class="fw-bold">
                                                <h4 class="text-gray-900 fw-bolder">We need your attention!</h4>
                                                <div class="fs-6 text-gray-700">To start using great tools, please, please
                                                <a href="#" class="fw-bolder">Create Team Platform</a></div>
                                            </div>
                                        </div>
                                    </div>
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
                            <div id="continuebtn">
                                <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
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
                                <button type="button" class="btn btn-lg btn-primary"  data-kt-stepper-action="next">Continue
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
@endsection

@section('js')

<script>

 $("#demailmin").hide()
 $("#demailcheck").hide()
 $("#demailcheckfalse").hide()
 $("#demailchecktrue").hide()
    function checkEmail(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            let valuenya = e.value;
            let sendData = {
                'value' : valuenya
            };

            if(valuenya.indexOf('@') <1){
                $("#demailchecktrue").hide()
                $("#demailcheck").hide()
                $("#demailcheckfalse").hide()
                $("#demailmin").show()
                $("#continuebtn").hide()

            }

            if(valuenya.indexOf('@') >= 1){
                $("#demailmin").hide()
                $("#demailcheck").show()

                var APP_URL = {!! json_encode(url('/checkemail')) !!}

                jQuery.ajax({
                    type: "POST",
                    url: APP_URL,
                    data: sendData,
                    cache: false,
                    success: function(response) {
                    if (response.success == true) {
                        $("#demailcheck").hide()
                        $("#demailcheckfalse").hide()
                        $("#demailchecktrue").show()
                        $("#continuebtn").show()

                    } else {
                        $("#demailchecktrue").hide()
                        $("#demailcheck").hide()
                        $("#demailcheckfalse").show()
                        $("#continuebtn").hide()
                    }
                }
            });

            }

        }
</script>
@endsection
