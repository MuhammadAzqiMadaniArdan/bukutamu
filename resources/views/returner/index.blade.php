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



        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 100%;
            padding: 0px 10px;

        }

        .jumbotron{
            padding: 0px 100px;
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
        }
    </style>
        @if (Session::get('success'))
        <br>
        
        @include('sweetalert::alert')
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('deleted'))
            <br>
            <div class="alert alert-success">
                {{ Session::get('deleted') }}
            </div>
        @endif
        <div class="jumbotron  mt-4">
            <div class="container">
                <h3><b>Returner</b> </h3>
                <p class="lead"><a href="/">Home</a>/<a href="{{ route('guest.index') }}">Guest</a>/<a
                        href="#">Returner</a></p>
            </div>
        </div>
        <form action="{{ route('guest.returner.search') }}" method="GET">
            <div class="form-inline mt-3 p-5">
                <div class="input-group searchPage" data-widget="sidebar-search">
                    <div class="input-group w-100" data-widget="sidebar-search">
                        <label style="width:12%;" for="search" class="form-label">No telp:</label>
                        <div class="d-flex w-100">
                            <input type="text" id="disabed" class="w-0" value="0" disabled>
                            <select class="form-control form-select w-100" id="livesearch" name="search" style="color:black;"></select>
                            <button type="submit" class="btn btn-sidebar" style="background: whitesmoke;"><i class="fas fa-search fa-fw"></i></button>
                            <a href="{{ route('guest.returner.index') }}" class="btn btn-danger ms-2 " style="border-radius:5px;">reset</a>
                        </div>
                    </div>
                </div>
            </div>

    </form>
    @if ($returner == null)
    @else
        <form action="{{ route('guest.returner.update',$returner[0]['id']) }}" class="card p-4 mt-5 m-5" method="POST">

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
                @foreach ($returner as $return)
                    <div class="col-sm-6 w-50 mb-2">
                        <input type="text" value="{{$return['name']}}" name="name" id="name" class="form-control"
                            placeholder="name*">
                    </div>
                    <div class="col-sm-6 w-50 mb-2">
                        <input type="email" value="{{$return['email']}}" name="email" id="email" class="form-control"
                            placeholder="Email Address*" required>
                    </div>
                    <div class="col-sm-6 w-50 mb-2 ">
                        <input type="no_telp" value="{{$return['no_telp']}}" name="no_telp" id="no_telp" class="form-control" placeholder="Phone Number*"
                            required>
                    </div>
                @endforeach
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
                        <input type=button value="Take Snapshot" onClick="take_snapshot()" class="ts mb-4 p-2 btn btn-success">
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
    @endif
    <div id="my_camera" hidden></div>
@endsection
@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
    
    <script type="text/javascript">
        let url = "{{ route('guest.returner.liveSearch') }}";
        let placeholder = 'Ketikkan No HP';


        $('#livesearch').select2({
            placeholder: placeholder,
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.no_telp,
                                id: item.id
                            }
                        })
                    };
                },

                cache: true
            }
        });
    </script>
@endpush