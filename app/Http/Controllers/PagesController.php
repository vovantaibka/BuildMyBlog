<?php
/**
 * Created by PhpStorm.
 * User: Vo Van Tai
 * Date: 22-Feb-17
 * Time: 10:43 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Post;
use App\Category;
use App\CategoryAudio;
use Mail;
use Session;

class PagesController extends Controller
{
    use ValidatesRequests;

    public function getIndex()
    {
        # process variable data or params
        # talk to the model
        # recieve from the model
        # compile or process data from the model if needed
        # pass that data to the correct view
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        $categories = Category::all();
        return view('pages.welcome')->withPosts($posts)->withCategories($categories);
    }

    public function getAbout()
    {
        $first = "T.T";
        $last = "Justin";
        $fullname = $first . " " . $last;
        $email = "taivv.hust@gmail.com";
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $fullname;
        return view('pages.about')->withData($data);
    }

    public function getContact()
    {
        return view('pages.contact');
    }


    public function postContact(Request $request)
    {
        $this->validate($request, array(
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10'
        ));

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from($data['email']);
            $message->to('Francy@trueplus.vn');
            $message->subject($data['subject']);
        });

        Session::flash('success', 'Your Email was Send!');

        return redirect('/');
    }
}