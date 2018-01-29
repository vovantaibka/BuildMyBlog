@extends('main')

@section('title', '| Contact')

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/about-contact.css') }}"/>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Contact Me</h1>
            <hr>
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label name="email">Email:</label>
                    <input id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label name="subject">Subject:</label>
                    <input id="subject" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label name="message">Message:</label>
                    <input id="message" name="message" class="form-control">
                </div>

                <input type="submit" value="Send Message" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection