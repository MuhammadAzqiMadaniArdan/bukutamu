@extends('layouts.template')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .jumbotron {
            border-radius: 10px;
            background-color: #007bff;
            color: white;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .small-box {
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box h4 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .small-box .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .small-box-footer {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
        }

        .small-box-footer:hover {
            text-decoration: underline;
        }

        .group {
            display: flex;
            justify-content: center;
        }
    </style>

    <div class="jumbotron">
        <div class="container">
            <h1>Welcome to Guest Books</h1>
            {{-- <p class="lead">Explore our guest books platform</p> --}}
        </div>
    </div>

    <div class="row mt-5 mb-3 w-100 group">
        <div class="small-box bg-gradient-success w-25 p-3">
            <div class="inner">
                <h4>Admin</h4>
            </div>
            <div class="icon">
                <i class="fa-solid fa-server"></i>
            </div>
            <a href="{{ route('login') }}" class="small-box-footer">Login <i class="fas fa-arrow-circle-right"></i></a>
        </div>

        <div class="small-box bg-gradient-info w-25 p-3">
            <div class="inner">
                <h4>Guest</h4>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <a href="{{ route('guest.index') }}" class="small-box-footer">Enter <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
@endsection
