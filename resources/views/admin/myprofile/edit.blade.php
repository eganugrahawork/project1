@extends('admin.layouts.main')

@section('content')
<div class="success-message" data-successmessage="{{ session('success') }}"></div>
<div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Account Overview</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Profile Details</h3>
        </div>
    </div>
    <div id="kt_account_profile_details" class="collapse show">
        <form  class="form" action="/admin/myprofile/updateprofile" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="oldimage" value="{{ auth()->user()->userdetail->image }}">
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Image</label>
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ url(asset('storage/'. auth()->user()->userdetail->image)) }})">
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ url(asset('storage/'. auth()->user()->userdetail->image)) }})"></div>
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
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Role</label>
                    <div class="col-lg-8 fv-row">
                        <input type="hidden" name="id_role" value="{{ auth()->user()->id_role }}">
                        <label class="col-form-label fw-bold fs-6">{{ auth()->user()->userrole->role }}</label>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                    <div class="col-lg-8 fv-row">
                                <input type="text" name="nama" class="form-control form-control-lg form-control-solid @error('nama')
                                    is-invalid
                                @enderror" value="{{ old('nama', auth()->user()->userdetail->nama) }}" />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Username</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="username" class="form-control form-control-lg form-control-solid @error('username')
                        is-invalid
                    @enderror" placeholder="Username" value="{{ old('username', auth()->user()->username) }}" />
                        @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">Contact Phone</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
                    </label>
                    <div class="col-lg-8 fv-row">
                        <input type="number" name="nokontak" class="form-control form-control-lg form-control-solid @error('nokontak')
                        is-invalid
                    @enderror" placeholder="Phone number" value="{{  old('nokontak', auth()->user()->userdetail->nokontak)  }}" />
                    @error('nokontak')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Email</label>
                    <div class="col-lg-8 fv-row">
                        <input type="hidden" name="email" class="form-control form-control-lg form-control-solid" value="{{ auth()->user()->email }}" />
                        <label class="col-form-label fw-bold fs-6">{{ auth()->user()->email }}</label>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Region</label>
                    <div class="col-lg-8 fv-row">
                        <select class="form-select form-select-solid" name="lokasi" required>
                                @foreach ( $lokasi as $l )
                                <option value="{{ $l->lokasi }}" @if (auth()->user()->userdetail->lokasi === $l->lokasi)
                                    selected
                                @endif>{{ $l->lokasi }}</option>
                                @endforeach
                        </select>

                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Address</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="alamat" class="form-control form-control-lg form-control-solid @error('alamat')
                        is-invalid
                    @enderror" value="{{ old('alamat', auth()->user()->userdetail->alamat) }}" />
                        @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">New Password</label>
                    <div class="col-lg-8 fv-row">
                        <div class="row">
                            <div class="col-lg-4 fv-row">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid @error('password')
                                is-invalid
                                @enderror" placeholder="New Password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 fv-row">
                                <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm new Password" class="form-control form-control-lg form-control-solid @error('password')
                                is-invalid
                                @enderror" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Password Verify Changed</label>
                    <div class="col-lg-8 fv-row">
                        <input type="password" name="oldpassword" class="form-control form-control-lg form-control-solid @error('oldpassword')
                        is-invalid
                    @enderror" />
                        @error('oldpassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>


@endsection
