<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\User;
use Session;
use Image;
use Storage;

class AccountController extends Controller
{
    use ValidatesRequests;

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
        $user = Auth::user();
        return view('account.index')->withUser($user);
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
        //Validate the data
        $user = User::find($id);

        $this->validate($request, array(
            'name' => 'required|max:255',
            'birth_day' => 'nullable|date',
            'gender' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable'
        ));

        $user->name = $request->input('name');
        $user->birth_day = $request->input('birth_day');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');

        if($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('imgs/' . $filename);
            Image::make($image)->widen(200)->save($location);
            $oldFilename = $user->image;
            $user->image = $filename;
            Storage::delete($oldFilename);
        }

        $user->save();

        Session::flash('success', 'You have successfully updated your profile information');

        return redirect()->route('account.edit', $user->id);
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

    public function changePassword()
    {
        die();
    }
}
