@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Hello {{ Auth::user()->name }}</h1>
        </div>
    </div>
@endsection