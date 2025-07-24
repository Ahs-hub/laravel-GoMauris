@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/customizeitinerary.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/customizeitinerary.css') }}">
    @endif




@endsection