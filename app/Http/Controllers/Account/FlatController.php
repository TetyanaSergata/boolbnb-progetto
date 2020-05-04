<?php

namespace App\Http\Controllers\Account;

use App\User;
use App\Flat;
use App\Image;
use App\Message;
use App\Extra_service;
use App\Promo_service;
use App\Flat_address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FlatController extends Controller
{

    private $validateRules;
    private $validateImage;
    private $validateImageEdit;

    public function __construct(){

        $this->middleware('auth');

        $this->validateRules =[
        'title'=> 'required|string|max:255',
        'rooms'=> 'required|numeric|integer',
        'street'=> 'required|string|max:255',
        'street_number'=> 'required|integer|numeric',
        'zip_code'=> 'required|numeric|digits_between:5,5',
        'city'=>'required|string|max:255',
        'mq'=> 'required|numeric|integer|min:15',
        'guest'=> 'nullable|string|max:150',
        'description'=> 'required|string|max:501',
        'price_day'=> 'required|numeric|integer',
        'beds'=> 'required|numeric|integer',
        'bathrooms'=> 'required|numeric|integer',
        'hidden'=> 'required|boolean',
        'lat' => 'required',
        'long' => 'required'
      ];
      $this->validateImage = [
          'cover'=> 'required|image'
      ];
      $this->validateImageEdit = [
          'cover'=> 'nullable|image'
      ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::where('user_id', Auth::id())->get();
        return view('user.list', compact('flats'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extra_services = Extra_service::all();
        $promo_services = Promo_service::all(); 

        return view('user.create', compact('extra_services', 'promo_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        $request->validate($this->validateRules);
        $request->validate($this->validateImage);
        $data = $request->all();
        $path = Storage::disk('public')->put('images', $data['cover']);
        $newFlat = new Flat;
        $newFlat->user_id = $idUser;
        $newFlat->title = $data['title'];
        $newFlat->rooms = $data['rooms'];
        $newFlat->guest = $data['guest'];
        $newFlat->mq = $data['mq'];
        $newFlat->description = $data['description'];
        $newFlat->beds = $data['beds'];
        $newFlat->hidden = $data['hidden'];
        $newFlat->price_day = $data['price_day'];
        $newFlat->bathrooms = $data['bathrooms'];
        $newFlat->slug = Str::finish(Str::slug($newFlat->title), rand(1, 1000));
        $newFlat->cover = $path;
        $newFlat->lat = $data['lat'];
        $newFlat->long = $data['long'];

        $saved = $newFlat->save();

        $newAddress = new Flat_address;
        $newAddress->street = $data['street'];
        $newAddress->street_number = $data['street_number'];
        $newAddress->zip_code = $data['zip_code'];
        $newAddress->city = $data['city'];
        $savedAddress = $newFlat->flat_address()->save($newAddress);

        if(!$saved) {
            return redirect()->back()->withInput();
        } 
        if(!$savedAddress) {
            return redirect()->back()->withInput();
        } 
        
        if(isset($data['extra_service'])) {
            $newFlat->extra_service()->attach($data['extra_service']);
        } 
        
        // if(isset($data['promo_service'])) {
        //     $newFlat->promo_service()->attach($data['promo_service']);
        // }

        // if ($request->validate($this->validateRules)->fails()) {
        //     return redirect()->back()->withInput();
        // }


        return redirect()->route('show.flat', $newFlat->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Usiamo show pubblica dell'altro controller
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $flat = Flat::where('slug', $slug)->first();
        $extra_services = Extra_service::all();
        $promo_services = Promo_service::all();
        $data = [
            'flat'=> $flat,
            'extra_services'=> $extra_services,
            'promo_services'=> $promo_services
        ];
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $idUser = Auth::user()->id;
        $flat = Flat::where('slug', $slug)->first();

        if (empty($flat)) {
            abort('404');
        }

        if($flat->user->id != $idUser){
            abort(404);
        }

        $request->validate($this->validateRules);
        $request->validate($this->validateImageEdit);
        $data = $request->all();
        $flat->title = $data['title'];
        $flat->rooms = $data['rooms'];
        $flat->guest = $data['guest'];
        $flat->mq = $data['mq'];
        $flat->description = $data['description'];
        $flat->beds = $data['beds'];
        $flat->hidden = $data['hidden'];
        $flat->price_day = $data['price_day'];
        $flat->bathrooms = $data['bathrooms'];
        $flat->slug = Str::finish(Str::slug($flat->title), rand(1, 1000));
        $flat->lat = $data['lat'];
        $flat->long = $data['long'];

        // if a new image was submitted
        if (isset($data['cover'])) {
            // delete old image stored
            Storage::disk('public')->delete($flat->cover);
            // save the image received
            $flat->cover = Storage::disk('public')->put('images', $data['cover']);
        }

        $flat->flat_address->street = $data['street'];
        $flat->flat_address->street_number = $data['street_number'];
        $flat->flat_address->city = $data['city'];
        $flat->flat_address->zip_code = $data['zip_code'];
        $updated = $flat->update();
        $updatedAddress = $flat->flat_address->update();

        if (!$updated) {
            return redirect()->back()->withInput();
        }

        if(isset($data['extra_service'])) {
            $flat->extra_service()->sync($data['extra_service']);
        } 
        
        // if(isset($data['promo_service'])) {
        //     $flat->promo_service()->sync($data['promo_service']);
        // } 

        return redirect()->route('show.flat', $flat->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        if(empty($flat)) {
            abort(404);
        }
        if (Auth::id() !== $flat->user_id) {
            abort(500);
        }
        $flat->extra_service()->detach();
        // $flat->promo_service()->detach();
        Storage::disk('public')->delete($flat->cover);
        $flat->delete();

        return redirect()->route('account.flats.index');
    }
}
