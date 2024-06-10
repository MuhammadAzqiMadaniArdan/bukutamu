@extends('layouts.template')

@section('content')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 5);
        }

        a {
            color: black;
            text-decoration: none;
        }

        .card {
            border-radius: 10px;
            /* background: whitesmoke; */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 5);
        }

        .btn span.glyphicon {
            opacity: 0;
        }

        .btn.active span.glyphicon {
            opacity: 1;
        }
     
       

        input,
        textarea {
            border: 0;
            border-radius: 6px;
            padding: 2%;
            background-color: darkgray;
            margin: 10px;
            box-sizing: border-box;
            flex-grow: 1;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 100%;
            padding: 0px 100px;

        }



        #top {
            color: green;
        }

        .group {
            width: auto;
            text-align: center;
        }

    </style>
     @php
     $data1 = [];
     $dataBulan = [];
        

         $validate1 = data_get($data1,'0.type',1);
        
        
     if ($validate1 == 'colocation') {
         $validate = true;
         }else
         {
             $validate = true;
         }
 
     @endphp
      @if (Session::get('success'))
      @include('sweetalert::alert')

      <div class="alert alert-success">{{ Session::get('success') }}</div>
  @endif
    <div class="jumbotron  mt-4" style="padding:0px;">
        <div class="container">
            <h3><b>Add New Rack</b> </h3>
            <p class="lead"><a href="/dashboard">Home</a>/<a
                    href="#">AddNewRack</a></p>
        </div>
    </div>
        @if($validate == true)
        
        <form action="{{ route('admin.rack.store') }}" class="card p-4 mt-5 m-5" method="POST">
            
            @csrf
            @if ($errors->any())
                {
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                }
            @endif
            <h3> Tambah Rack</h3>
            <div class="row mt-3">
               
                <div class="col-sm-6 w-50 mb-2">
                    <input type="text" name="name" id="name" class="form-control" placeholder="name*">
                </div>
                <div class="col-sm-6 w-50 mb-3" style="margin-left:1%;">
                    <select name="datacenter" id="datacenter" class="form-control">
                        <option value="none" disabled selected hidden>Pilih Datacenter</option>
                        @foreach ($datacenters as $datacenter)
                                    <option value="{{ $datacenter['id'] }}">
                                        <p> {{ $datacenter['name'] }}</p>
                                    </option>
                    @endforeach
                    </select>
                </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

    @else
    <div class="card p-5 mt-5 mb-5" >

    <div class="alert alert-danger mt-2 p-5" ><h3 style="text-align: center;">Pesanan Client Bukan Produk Dengan Tipe Colocation !</h3></div>

    </div>
    @endif    
@endsection