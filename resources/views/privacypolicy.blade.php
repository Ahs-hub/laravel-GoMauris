@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endif
    
@endsection