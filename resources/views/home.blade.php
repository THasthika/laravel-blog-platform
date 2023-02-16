@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <div>
        <h2 class="text-xl">Recent Posts</h2>

        <div>
            Post
        </div>
    </div>

@endsection


@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection