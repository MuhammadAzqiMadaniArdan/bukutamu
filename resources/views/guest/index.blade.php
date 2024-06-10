@extends ('layouts.template')

@section('content')
    <style>
        .guestlist {
            padding: 20px;
            display: grid;
            grid-template-rows: 1fr 3fr;
            gap: 2em;
        }

        .btn {
            grid-area: btn;
        }

        .card {
            text-align: center;
            padding: 30px 10px;
            border-radius: 30px;
            transition: transform 0.3s;
            box-shadow: #000 5px 2px 5px;
        }
        .card:hover {
            transform: translateY(-5px);
        }

        .top {
            max-width: 100%;
            padding: 0px 10%;

        }
        a{
            text-decoration: none;
            color: #000;
        }
        i{
            font-size: 50px;
        }
        .title::after {
    margin-top: 10px;
    content: " ";
    display: block;
    border: 2px solid black;
    width: 10%;
}
         
    </style>
            @include('sweetalert::alert')

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    {{-- <a href="{{ route('webcam') }}">webcam</a> --}}
    <div class="jumbotron mt-4" style="padding:0px;">
        <div class="container top">
            <h2><b>Guest</b> </h2>
            <p class="lead"><a href="/">Home</a>/<a href="{{ route('guest.index') }}">Guest</a></p>
        </div>
    </div>
    <section class="guestlist">
        
        <div class="container-lg mt-3">

            <a href="{{ route('guest.returner.index') }}" class="btn btn-success btn-lg ">Returner</a>
            <a href="{{ route('guest.guest.create') }}" class="btn btn-primary btn-lg">New Guest</a>
            <a href="{{ route('index') }}" class="btn btn-secondary btn-lg">Back</a>
        </div>
        <div class="container-lg">
            
            <div class="title">
                <h1><b>CheckIn Groups</b></h1>
            </div>
        
            <div class="row mt-1 mb-5 w-100 group">
                @if ($checkIns == null)
                @else
                <div class="row row-cols-1 mb-3 row-cols-md-3 g-4">
                    @foreach ($checkIns as $checkUser)
                    @php
                    $image = $checkUser['image'];
                    // $FilePath = storage_path('app/public/6662e6abe8d6f.png');
                    ;
                    // dd($FilePath);
                    @endphp
                    {{-- {{now()}} --}}
                            <div class="col">
                                <div class="card mb-3">
                                    {{-- @dd( $image,storage_path(`app/uploads/$image`)) --}}
                                    {{-- <img src="" class="card-img-top fa-solid fa-arrow-right-to-bracket" alt="..."> --}}
                                    <h4 class="card-title p-1">{{ $checkUser->guest->name }}
                                    </h4>
                                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                        <div class="card-body">
                                        <a href="#" class="btn btn-danger" data-bs-target="#checkoutModalLabel" onclick="openCheckoutModal({{ $checkUser->id }})">
                                            Checkout 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    
                @endif


            </div>
        </div>

        </div>

    </section>
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Input Nomor Telepon</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="checkoutUserId" name="checkoutUserId">

                    <form id="checkoutForm" action="" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon:</label>
                            <input type="notelp" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                    
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    
@endsection
@push('script')
<script>
   function openCheckoutModal(id) {
    $('#checkoutUserId').val(id);
    $('#checkoutForm').attr('action', "{{ route('checkout', '') }}/" + id);
    $('#checkoutModal').modal('show');
}


function handleCheckout() {
    let noTelp = $('#no_telp').val();
    let id = $('#checkoutUserId').val();
    
    if (id == null) {
        id = 1;
    }
    // Lakukan validasi nomor telepon di sini jika diperlukan
    // Contoh validasi: nomor telepon harus diisi
    if (noTelp.trim() === '') {
        alert('Nomor telepon harus diisi');
        return;
    }

    // Lanjutkan dengan rute 'checkout' jika nomor telepon valid
    window.location.href = "{{ route('checkout', '') }}/" + id;
}

</script>

@endpush