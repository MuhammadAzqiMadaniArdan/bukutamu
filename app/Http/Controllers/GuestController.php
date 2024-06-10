<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\File;
use App\Models\Check_in_out;
use App\Models\Guest;
use App\Models\Rack;
use App\Models\Datacenter;
use App\Models\Activities;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Http\Request;
use Storage;


class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $checkIns = Check_in_out::where('checkout', null)->get();
        $checked = [];
        foreach ($checkIns as $check) {
            array_push($checked, $check);
        }


        return view('guest.index', compact('checkIns'));
    }

    public function liveSearch(Request $request)
    {





        $movies = [];
        if ($request->has('q')) {
            $search = $request->q;
            $movies = Guest::select('id', 'no_telp')->where('no_telp', 'LIKE', "%$search%")->get();
        }
        return response()->json($movies);

        // dd($dedicated1,$dedic1,$colocation);
        return view('returner.index', compact('returner'))->with('success', 'login berhasil!');
    }

    public function search(Request $request)
    {

        $search = $request->input('search');
        if ($search == null) {
            $returner = null;
        } else {

            $returner = Guest::where('id', 'like', "%$search%")->get();

            $checkIn = Check_in_out::where('guest_id', "$search")->get();
            $checked = $checkIn[0]['checkout'];
            $datar = [];
            foreach ($returner as $return) {
                array_push($datar, $return);
            }
            if ($datar == null || $checked == null) {
                $returner = null;
            }

        }


        $datacenters = Datacenter::orderBy('name', 'ASC')->get();
        $racks = Rack::orderBy('name', 'ASC')->get();
        $activities = Activities::orderBy('activity', 'ASC')->get();

        return view('returner.index', compact('returner', 'datacenters', 'racks', 'activities'));
    }

    public function returnerIndex()
    {
        $returner = null;
        $datacenters = Datacenter::orderBy('name', 'ASC')->get();
        $racks = Rack::orderBy('name', 'ASC')->get();
        $activities = Activities::orderBy('activity', 'ASC')->get();


        return view('returner.index', compact('returner', 'datacenters', 'racks', 'activities'));
    }

    public function returnerUpdate(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'activity' => 'required',
            'datacenter' => 'required',
            'rack' => 'required',
            'image' => 'required',
        ]);

        $return = Check_in_out::where('guest_id', $id)->get();
        // dd($return[0]);
        $previousFile = storage_path('app/uploads/' . $return[0]['image']);

        if (File::exists($previousFile)) {
            File::delete($previousFile);
        }

        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        // dd($fileName);
       

        Check_in_out::where('guest_id', $id)->update([
            'datacenter_id' => $request->datacenter,
            'rack_id' => $request->rack,
            'activities_id' => $request->activity,
            'checkin' => date(now()),
            'checkout' => null,
            'image' => $fileName,
        ]);

        Guest::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp'=> $request->no_telp,
        ]);



        return redirect()->route('guest.index')->with('success', 'Berhasil CheckIn');
    }

    public function create()
    {
        $datacenters = Datacenter::orderBy('name', 'ASC')->get();
        $racks = Rack::orderBy('name', 'ASC')->get();
        $activities = Activities::orderBy('activity', 'ASC')->get();

        return view('guest.create', compact('datacenters', 'racks', 'activities'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'activity' => 'required',
            'datacenter' => 'required',
            'rack' => 'required',
            'image' => 'required',
        ]);

        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        // dd('Image uploaded successfully: '.$fileName);

        $prosesTambahData = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'user_id' => $request->userId,
        ]);
        Check_in_out::create([
            'guest_id' => $prosesTambahData->id,
            'datacenter_id' => $request->datacenter,
            'rack_id' => $request->rack,
            'activities_id' => $request->activity,
            'checkin' => $prosesTambahData->updated_at,
            'checkout' => null,
            'image' => $fileName,
        ]);

        return redirect()->route('guest.index')->with('success', 'Berhasil CheckIn');
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
