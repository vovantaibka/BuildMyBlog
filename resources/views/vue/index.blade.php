@extends('layouts.app')

@section('content')
    {{-- <h1>This is a vue component</h1> --}}
    {{-- <example></example> --}}
    <h1>Hello App!</h1>
	  <p>
	    <!-- use router-link component for navigation. -->
	    <!-- specify the link by passing the `to` prop. -->
	    <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
	    <router-link to="/foo">Go to Foo</router-link>
	    <router-link to="/bar">Go to Bar</router-link>
	  </p>
    <router-view></router-view>
@endsection