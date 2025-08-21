@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('title', 'Booking Confirmation')

@section('content')
<div class="container text-center py-5" style="min-height: 60vh;">
        <h1 class="text-success mb-3">
            <i class="bx bx-check-circle"></i> {{ __('messages.thank_you') }}!
        </h1>
        <p class="lead">{{ __('messages.your_request_has_been_received_sucess') }}.</p>
        <p>{{ __('messages.our_team_will_get_back_to_you_ect') }}.</p>
        <a href="{{ request('type') === 'car' ? url('/rent-cars') : url('/') }}" class="btn btn-outline-primary mt-4">
            <i class="bx bx-home"></i> {{ __('messages.back_to_home') }}
        </a>
</div>
@endsection
