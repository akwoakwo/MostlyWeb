@extends('customer.setup.app')
@section('title','Review Pesan - MostlyWeb')

@section('content')

  <style>
    .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    }

    .rating > input{ display:none;}

    .rating > label {
        width: 1em;
        font-size: 3vw;
        color: #FFD600;
        cursor: pointer;
    }
    .rating > label::before{ 
    content: "\2605";
    position: absolute;
    opacity: 0;
    }
    .rating > label:hover:before,
    .rating > label:hover ~ label:before {
    opacity: 1 !important;
    }

    .rating > input:checked ~ label:before{
    opacity:1;
    }

    .rating:hover > input:checked ~ label:before{ opacity: 0.4; }

    @media only screen and (max-width: 600px) {
      .rating > label {
          font-size: 10vw; 
      }
    }
  </style>

<section class="p-4 col-md-9 col-lg-10  w-100">
    <h3 class="fw-bold mb-4">Review Pemesanan</h3>

    <div class="card shadow-sm p-4">

        <div class="row">
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="card-body my-4">
                        <div>
                            <img src="{{ asset('assets/img/'.$data->produk->gambar_produk) }}" alt="{{ $data->produk->gambar_produk }}" class="img-fluid">
                        </div>
                        <div class="mt-2">
                            <div class="table-responsive">
                                <table class="table">
                                  <tr>
                                        <td> Tanggal Pesan </td>
                                        <td> : </td>
                                        <td> {{ $data->created_at ? $data->created_at->translatedFormat('d F Y') : '-' }} </td>
                                    </tr>
                                    <tr>
                                        <td> Jenis Paket </td>
                                        <td> : </td>
                                        <td> {{ $data->subpaket->nama_subpaket }}</td>
                                    </tr>
                                    <tr>
                                        <td> Jenis Desain </td>
                                        <td> : </td>
                                        @if ($data->produk_id)
                                            <td> {{ $data->produk->nama_produk }} </td>
                                        @else
                                            <td> Custom </td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-secondary" href="/riwayat-pesan">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="card-body">
                    <p class="text-center"> Bagaimana pengalaman Anda bekerja sama dengan kami dalam proses pembuatan website? </p>
                    <form action="/review-pesan" method="post">
                        @csrf
                        <input type="hidden" value="{{ $data->id }}" name="pemesanan_id" class="btn btn-outline-dark w-100 shadow-none mb-3">
                        <div class="rating mb-2">
                            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                        </div>
                        <textarea rows="4" name="ulasan" class="form-control shadow-none mb-3" required></textarea>
                        <button class="btn btn-outline-success mb-3" type="submit">Kirim Ulasan</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function() {
    return $star_rating.each(function() {
        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
        return $(this).removeClass('fa-star-o').addClass('fa-star');
        } else {
        return $(this).removeClass('fa-star').addClass('fa-star-o');
        }
    });
    };

    $star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
    });

    SetRatingStar();
    $(document).ready(function() {

    });
</script>

@endsection
