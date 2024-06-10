@extends ('layouts.template')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <style>
        body {
            padding: 2em;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        a:hover {
            color: #0056b3;
        }

        .jumbotron {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .display-4 {
            font-size: 2.5rem;
        }

        .lead {
            font-size: 1.25rem;
            margin-top: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .small-box {
            margin-right: 10px;
            max-width: 100%;
        }

        p {
            text-align: start;
            font-size: 500px;

        }

        .inner {
            max-width: 100%;

        }
        @media (max-width: 768px) {
            .container {
              padding: 0 15px;
              }
              h4{

                font-size: 15px;
              }
        }

        @media (max-width: 576px) {
            .display-4 {
                font-size: 2rem;
            }

            .lead {
                font-size: 1rem;
            }
            p {
            text-align: start;
            font-size: 200px;
        }
        h4{
            font-size: 13px;

        }
        }

       
        .gd{
          display: flex;
          justify-content: space-between;
        }
    </style>
      <div class="gd">
        
        <div class="gd2">
          <a class="btn btn-primary" href="{{ route('admin.datacenter') }}">Datacenter</a>
          <a class="btn btn-primary" href="{{ route('admin.rack') }}">Rack</a>
          <a class="btn btn-primary" href="{{ route('admin.activities') }}">Activities</a>
          </div>
            <div class="gd1">
              <a class="btn btn-danger" href="{{ route('auth-logout') }}">Logout</a>
              </div>
</div>
    <div class="jumbotron p-4 bg-light mt-5">
        <div class="container">
            @if (Session::get('success'))
                <br>
                @include('sweetalert::alert')
            @endif
            {{-- @if (Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif --}}
            <h1 class="display-4">Buku Tamu App</h1>
            {{-- <h3>Selamat Datang , </h3> --}}
            <h3>Selamat Datang , {{ Auth::user()->name }}</h3>
            <p class="lead">Aplikasi Buku untuk mendapatkan informasi terkait tamu</p>
        </div>
    </div>

    <div class="row mt-5 mb-3 w-100 group">

        <div class="small-box bg-gradient-success w-25 h-100 p-3">
            <div class="inner">
                <h4>Datacenter</h4>
            </div>
            <div class="icon">
                <i class="fa-solid fa-server"></i>
            </div>
            <a href="{{ route('admin.datacenter') }}" class="small-box-footer p-2">
                Enter <p class="fas fa-arrow-circle-right"></p>
            </a>
        </div>
        <div class="small-box bg-gradient-info w-25 p-3">
            <div class="inner">
                <h4>Activities</h4>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <a href="{{ route('admin.activities') }}" class="small-box-footer p-2">
                Enter <p class="fas fa-arrow-circle-right"></p>
            </a>
        </div>
        <div class="small-box bg-gradient-danger w-25 p-3">
            <div class="inner">
                <h4>Rack</h4>
            </div>
            <div class="icon">
              <i class="fa-solid fa-box-archive"></i>
                        </div>
            <a href="{{ route('admin.rack') }}" class="small-box-footer p-2">
                Enter <p class="fas fa-arrow-circle-right"></p>
            </a>
        </div>

    </div>
@endsection
