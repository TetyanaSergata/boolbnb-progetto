<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

     private $validateRules;

    public function __construct(){

        $this->middleware('auth');

        $this->validateRules =[
        'name'=> 'required|string|max:10',
        'email'=> 'required|email',
        'passwordnow'=> 'required',
        'passwordnew'=> 'required|min:8',
        'confirm'=> 'required|same:passwordnew',
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $user = User::where('id', $id)->first();
        return view('user.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->validateRules);
        $user = User::where('id', Auth::user()->id)->first();
        $userOldPassword = $user->password;
        $data = $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['passwordnew']);

        if (Hash::check($data['passwordnow'], $userOldPassword)) {
            $updated = $user->update();
            if (!$updated) {
                return redirect()->back()->withInput();
            }
        } else {
            return Redirect::back()->withErrors('Password errata');
        }
        
        return redirect()->route('account.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
