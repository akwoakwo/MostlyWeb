@extends('customer.setup.app')
@section('title','Riwayat Pesan - MostlyWeb')

@section('content')
<section class="p-4 col-md-9 col-lg-10">
    <h3 class="fw-bold mb-4">Riwayat Pemesanan</h3>

        <div class="row">
            @foreach ($data as $item)
                <div class="col-md-6 my-3">
                    <div class="card">
                        <div class="card-body my-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/img/'.$item->produk->gambar_produk) }}" alt="{{ $item->produk->gambar_produk }}" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td> Tanggal Pesan </td>
                                                <td> : </td>
                                                <td> {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }} </td>
                                            </tr>
                                            <tr>
                                                <td> Jenis Paket </td>
                                                <td> : </td>
                                                <td> {{ $item->subpaket->nama_subpaket }}</td>
                                            </tr>
                                            <tr>
                                                <td> Jenis Desain </td>
                                                <td> : </td>
                                                <td> be belom </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                @if ($item->ulasan === null)  
                                  <div class="d-flex justify-content-center">
                                      <a class="btn btn-primary" href="/review-pesan/{{ $item->id }}">Ulasan</a>
                                  </div>
                                @else
                                <p>
                                    <b>Ulasan anda </b> : 
                                    @if ($item->ulasan->rating == 5)
                                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    @elseif ($item->ulasan->rating == 4)
                                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    @elseif ($item->ulasan->rating == 3)
                                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    @elseif ($item->ulasan->rating == 2)
                                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    @elseif ($item->ulasan->rating == 1)
                                      <i class="bi bi-star-fill"></i>
                                    @endif

                                    <br> {{ $item->ulasan->ulasan }}
                                </p>
                                @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</section>

@endsection
