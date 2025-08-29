@extends('admin.setup.app')
@section('title','Dashboard - Admin MostlyWeb')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-4 mb-4">
        <div class="position-relative">
            <div class="border border-2 border-primary rounded-circle">
            <img src="{{ asset('assets/img/'.auth()->user()->gambar) }}" class="rounded-circle m-1" alt="user1" width="60" />
            </div>
        </div>
        <div>
            <h3 class="fw-semibold">Hi, <span class="text-dark">{{ Auth::user()->name }}</span>
            </h3>
            <span>Cheers, and happy activities - July 6 2023</span>
        </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Sales Overview</h5>
                    </div>
                    <div>
                        <select class="form-select">
                            <option value="1">March 2023</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                        </select>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>
</div>

@endsection
