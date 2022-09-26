@extends('admin.layouts.main')


@section('content')
<link rel="stylesheet" href="/css/admin/cardshow.css">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <div class="card p-3 py-4">
                <div class="text-center">
                    <img src="{{ asset('storage/'.$user->userdetail->image) }}" width="100" class="rounded-circle">
                </div>
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">{{ $user->userrole->role }}</span>
                    <h5 class="mt-2 mb-0">{{ $user->userdetail->nama }}</h5>
                </div>
                <hr>
                    <div class="row ">
                        <div class="col-lg-6">
                            <p>Username : <span>{{ $user->username }}</span></p>
                            <p>E-mail :  <span>{{ $user->email }} </span></p>
                            <p>No. Telp :  <span>{{ $user->userdetail->nokontak }} </span></p>
                        </div>
                        <div class="col-lg-6">
                            <p>Wilayah :  <span>{{ $user->userdetail->lokasi }} </span></p>
                            <p>Alamat :  <span>{{ $user->userdetail->alamat }} </span></p>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
