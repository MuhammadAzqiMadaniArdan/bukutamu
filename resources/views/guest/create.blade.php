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
            background-color: #fff;
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
            width: 100%;
            flex-grow: 1;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 100%;
            padding: 0px 10px;
        }

        #top {
            color: green;
        }

        .group {
            width: auto;
            text-align: center;
        }

        #results {
            padding: 10px;
            border: 1px solid;
            background: #ccc;
            width: 270px;
            height: 230px;
        }

        @media (max-width: 870px) {
            .rc{
                width: 60%;
            }
            .card{
                font-size: 10px;
            }
        }
        .jumbotron{
            padding: 0px 100px;
        }
        
    </style>

    @php
        $data1 = [];
        $dataBulan = [];

        //  dd($data1,$productEntry['entryData'],$EntryAll,$dataBulan);

        $validate1 = data_get($data1, '0.type', 1);

        if ($validate1 == 'colocation') {
            $validate = true;
        } else {
            $validate = true;
        }

    @endphp
    
    <div class="jumbotron  mt-4" >
        <div class="container">
            <h3><b>Add New Guest</b> </h3>
            <p class="lead"><a href="/">Home</a>/<a href="{{ route('guest.index') }}">Guest</a>/<a
                    href="#">AddNewGuest</a></p>
        </div>
    </div>
    @if ($validate == true)

        <form action="{{ route('guest.guest.store') }}" class="card p-4 mt-5 m-5" method="POST">

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
            <h3> Personal Information</h3>
            <div class="row mt-3">

                <div class="col-sm-6 w-50 mb-2">
                    <input type="text" name="name" id="name" class="form-control" placeholder="name*">
                </div>
                <div class="col-sm-6 w-50 mb-2">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address*"
                        required>
                </div>
                <div class="col-sm-6 w-50 mb-2 ">
                    <input type="no_telp" name="no_telp" id="no_telp" class="form-control" placeholder="Phone Number*"
                        required>
                </div>
            </div>
            <hr>
            <h3>Guest Needs</h3>
            <div class="row mt-3">
                <div class="col-sm-6 w-50 mb-3" style="margin-left:1%;">
                    <select name="datacenter" id="datacenter" class="form-control" required>
                        <option value="none" disabled selected hidden>Pilih Datacenter</option>
                        @foreach ($datacenters as $datacenter)
                            <option value="{{ $datacenter['id'] }}">
                                <p> {{ $datacenter['name'] }}</p>
                            </option>
                        @endforeach
                        </select>
                        </div>
                        
                        <div class="col-sm-6 w-25 mb-3" style="margin-left:-0.1%;">
                            <select name="rack" id="rack" class="form-control">
                        <option value="none" disabled selected hidden>Pilih Rak</option>
                        @foreach ($racks as $rack)
                        <option value="{{ $rack['id'] }}" data-datacenter-id="{{ $rack['datacenter_id'] }}">
                            {{ $rack['name'] }}
                        </option>
                    @endforeach
                    </select>
                    </div>
                    
                <div class="col-sm-6 w-50 mb-3" style="margin-left:1%;">
                    <select name="activity" id="activity" class="form-control">
                        <option value="none" disabled selected hidden>Pilih Aktivitas</option>
                        @foreach ($activities as $activity)
                            <option value="{{ $activity['id'] }}">
                                <p> {{ $activity['activity'] }}</p>
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>
                <hr>

                <h3>Image Capture</h3>
                <div class="row">
                    <div class="row mt-3">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br />
                        <input type=button value="Take Snapshot" onClick="take_snapshot()" class="ts w-50 mb-4 p-2 btn btn-success">
                        <input type="hidden" name="image" class="image-tag" required>
                    </div>
                    <div class="col-md-6 rc">
                        <div id="results">Your captured image will appear here...</div>
                    </div>
                    <div class="col-md-12 text-center">
                        <br />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    @else
        <div class="card p-5 mt-5 mb-5" >

            <div class="alert alert-danger mt-2 p-5">
                <h3 style="text-align: center;">Mana ada !</h3>
            </div>

        </div>
    @endif
    @include('sweetalert::alert')

    
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#datacenter').change(function() {
            let selectedDatacenterId = $(this).val();
            $('#rack option').each(function() {
                let rackDatacenterId = $(this).data('datacenter-id');
                if (rackDatacenterId == selectedDatacenterId || selectedDatacenterId == 'none') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
    <script>
        Webcam.set({
            width: 250,
            height: 200,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img  src="' + data_uri + '"/>';
            });
        }
    </script>
@endpush
