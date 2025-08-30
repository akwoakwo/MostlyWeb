@extends('admin.setup.app')
@section('title','Data Admin - Admin MostlyWeb')

@section('content')

    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Admin</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Data Admin
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success customize-alert alert-dismissible border-success text-success fade show remove-close-icon" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="d-flex align-items-center font-medium me-3 me-md-0">
                        <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                        {{ session('success') }}
                    </div>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger customize-alert alert-dismissible border-danger text-danger fade show remove-close-icon" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="d-flex align-items-center font-medium me-3 me-md-0">
                        <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                        {{ session('error') }}
                    </div>
                    </div>
                @endif
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between m-3">
                            {{-- tambah data --}}
                            <b> {{ $data->count() }} ADMIN </b>
                            <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modal-baru">Tambah Admin Baru</button>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="editable-datatable">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No Telpon</th>
                                <th>Email</th>
                                <th>Profile</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <th>{{ $index+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                @if($item->gambar)
                                    <img src="{{ asset('assets/img/' . $item->gambar) }}" alt="profile" width="50">
                                @else
                                    -
                                @endif
                                </td>
                                <td>
                                    @if ($item->id === auth()->user()->id)
                                        <a href="" class="btn btn-primary btn-sm"> <i class="ti ti-pencil"></i> </a>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"> <i class="ti ti-trash"></i> </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection