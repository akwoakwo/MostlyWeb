@extends('customer.setup.app')
@section('title','Profil - MostlyWeb')

@section('content')
<section class="p-4 col-md-9 col-lg-10 w-100">
    <h3 class="fw-bold mb-4">Pengaturan Profil</h3>

    {{-- Alert success / error --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 text-center">
                @if (auth()->user()->google_id != null)
                    <img id="previewImage"
                        src="{{ auth()->user()->avatar }}"
                        alt="Profile"
                        class="rounded-circle mb-3"
                        style="width:120px; height:120px; object-fit:cover;">
                    <input type="file" name="avatar" id="profileImage" class="form-control" accept="image/*">
                @else
                    
                <img id="previewImage"
                    src="{{ asset('assets/img/'.auth()->user()->gambar) }}"
                    alt="Profile"
                    class="rounded-circle mb-3"
                    style="width:120px; height:120px; object-fit:cover;">
                    <input type="file" name="gambar" id="profileImage" class="form-control" accept="image/*">
                @endif
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$user->name) }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">No HP</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone',$user->phone) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email',$user->email) }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Isi jika ingin diubah">
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Update Profil</button>
        </form>
    </div>
</section>
@endsection
