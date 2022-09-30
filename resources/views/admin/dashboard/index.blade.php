@extends('admin.layouts.main')

@section('content')
<!--begin::Toolbar-->
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-xxl py-5">
        <!--begin::Row-->
        <div class="row gy-0 gx-10">
            <div class="col-xl-8">
                <!--begin::Engage widget 2-->
                <div class="card card-xl-stretch bg-body border-0 mb-5 mb-xl-0">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column flex-lg-row flex-stack p-lg-15">
                        <!--begin::Info-->
                        <div class="d-flex flex-column justify-content-center align-items-center align-items-lg-start me-10 text-center text-lg-start">
                            <!--begin::Title-->
                            <h3 class="fs-2hx line-height-lg mb-5">
                                <span class="fw-bold">Brilliant App Ideas</span>
                                <br />
                                <span class="fw-bolder">for Startups</span>
                            </h3>
                            <!--end::Title-->
                            <div class="fs-4 text-muted mb-7">Long before you sit down to put the pen
                            <br />need to make sure you breathe</div>
                            <a href='#' class="btn btn-success fw-bold px-6 py-3" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create an Store</a>
                        </div>
                        <!--end::Info-->
                        <!--begin::Illustration-->
                        <img src="assets/media/illustrations/sketchy-1/11.png" alt="" class="mw-200px mw-lg-350px mt-lg-n10" />
                        <!--end::Illustration-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 2-->
            </div>
            <div class="col-xl-4">
                <!--begin::Mixed Widget 16-->
                <div class="card card-xl-stretch bg-body border-0">
                    <!--begin::Body-->
                    <div class="card-body pt-5 mb-xl-9 position-relative">
                        <!--begin::Heading-->
                        <div class="d-flex flex-stack">
                            <!--begin::Title-->
                            <h4 class="fw-bolder text-gray-800 m-0">User Base</h4>
                            <!--end::Title-->
                            <!--begin::Menu-->
                            <div class="me-1">
                                <button class="btn btn-icon btn-color-gray-500 w-auto px-0 btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                    <span class="svg-icon svg-icon-1 me-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black" />
                                            <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                            <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                            <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>

                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Chart-->
                        <div class="d-flex flex-center mb-5 mb-xxl-0">
                            <div id="kt_charts_mixed_widget_16_chart" style="height: 260px"></div>
                        </div>
                        <!--end::Chart-->
                        <!--begin::Content-->
                        <div class="text-center position-absolute bottom-0 start-50 translate-middle-x w-100 mb-10">
                            <!--begin::Text-->
                            <p class="fw-bold fs-4 text-gray-400 mb-7 px-5">Long before you sit down to put the
                            <br />make sure you breathe</p>
                            <!--end::Text-->
                            <!--begin::Action-->
                            <div class="m-0">
                                <a href='#' class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">Invite Users</a>
                            </div>
                            <!--ed::Action-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 16-->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
@endsection
