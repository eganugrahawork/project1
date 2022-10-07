@extends('admin.layouts.main')


@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="success-message" data-successmessage="{{ session('success') }}"></div>

        <div class="card-body">
            <h5 class="card-title mb-4 text-center">Create New User</h5>
            <div class="container text-center">
                <form action="/admin/users/update" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="id_detail_user" value="{{ $user->id_detail_user }}">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="nama" class="col-md-4 col-form-label text-md-end">Nama</label>
                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control @error('nama')
                                        is-invalid
                                    @enderror" name="nama" value="{{ old('nama', $user->userdetail->nama) }}" required autocomplete="nama" autofocus>
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-md-4 col-form-label text-md-end">Alamat</label>
                                <div class="col-md-6">
                                    <textarea id="alamat" class="form-control @error('alamat')
                                    is-invalid
                                @enderror" name="alamat" required  autofocus>{{ old('alamat',$user->userdetail->alamat) }}</textarea>
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nokontak" class="col-md-4 col-form-label text-md-end">No Telp.</label>
                                <div class="col-md-6">
                                    <input id="nokontak" type="number" class="form-control @error('nokontak')
                                    is-invalid
                                    @enderror" value="{{ old('nokontak',$user->userdetail->nokontak) }}" name="nokontak" required autocomplete="nokontak" autofocus>
                                    @error('nokontak')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" value="{{old('email', $user->email) }}" class="form-control @error('email')
                                    is-invalid
                                    @enderror" name="email" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="id_role" class="col-md-4 col-form-label text-md-end">Role</label>
                                <div class="col-md-6">
                                    <select class="form-select" name="id_role">
                                        @foreach ($role as $r )
                                            <option @if ($r->id == $user->id_role)
                                                selected
                                            @endif value="{{ $r->id }}">{{ $r->role }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="lokasi" class="col-md-4 col-form-label text-md-end">Wilayah</label>
                                <div class="col-md-6">
                                    <input id="lokasi" type="text" value="{{ old('lokasi',$user->userdetail->lokasi) }}" class="form-control @error('lokasi')
                                    is-invalid
                                    @enderror" name="lokasi" required autocomplete="lokasi" autofocus>
                                    @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" value="{{ old('username',$user->username) }}" class="form-control @error('username')
                                    is-invalid
                                    @enderror" name="username" required autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password')
                                        is-invalid
                                    @enderror" name="password" autocomplete="password" autofocus>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('storage/'. $user->userdetail->image) }}" alt="" style="width:100px; height:100px; display:block; margin-left:auto; margin-right:auto;" class="img-preview">
                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="oldimage" value="{{ $user->userdetail->image }}">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control form-control-sm @error('image')
                            is-invalid
                            @enderror" id="image" name="image" type="file" onchange="previewImage()">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
{{-- Preview Image --}}
<script>
    function previewImage(){
        const image = document.querySelector('#image')
        const imgPreview = document.querySelector('.img-preview')

        // imgPreview.style.display ='block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
{{-- End Preview Image --}}

@endsection
