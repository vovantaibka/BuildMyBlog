<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;
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
        $user = User::find($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $user->save();

        // Session::flash('success', 'You have successfully updated your profile information');

        return $user;
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

    // public function changePassword()
    // {
    //     die();
    // }

    /**
     * [uploadImageFile description]
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadImageFile(Request $request, $id)
    {
        $user = User::find($id);

        // $this->validate($request, [
        //     'image' => 'required|image'
        // ]);

        if($request->get('image')) {
            $image = $request->get('image');
            $fileImageName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->heighten(200)->save(public_path('imgs/').$fileImageName);
            $oldFilename = $user->image;
            $user->image = $fileImageName;
            Storage::delete($oldFilename);

            $user->save();

            return response()->json(['error' => false, 'fileImageName' => $fileImageName]); 
        } else {
            return response()->json(['errors' => true]);
        }
    }
}
