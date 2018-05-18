<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use Image;
use Session;

class AudioController extends Controller
{
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->action === 'create') {
            $audio = new Audio();

            $audio->title = $request->title;
            $audio->link = $request->link;
            $audio->introduce = $request->introduce;

            if ($request->hasFile('audio_image')) {
                $image = $request->file('audio_image');
                $filename = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('imgs/'.$filename);
                Image::make($image)->widen(300)->save($location);

                $audio->image = $filename;
            }

            $audio->save();

            Session::flash('success', 'The audio was successfully save!');
        } else {
        }

        return redirect()->route('admin.main', 'audio');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
