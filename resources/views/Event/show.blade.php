@include('_header')
@include('_navigation')
<div class="container">
    <h1>{{ $event->title }}</h1>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $event->thumbnail) }}" class="img-fluid">
        </div>
        <div class="col-md-8">
            <p>{{ $event->details }}</p>
            <p>Venue: {{ $event->venue }}</p>
            <p>City: {{ $event->city }}</p>
            <p>Start Date and Time: {{ $event->start_datetime }}</p>
            <p>End Date and Time: {{ $event->end_datetime }}</p>
            @if($event->user_id === auth()->id())
                <a href="{{ route('event.attendees', $event->id) }}" class="btn btn-secondary">View Attendees</a>
            @else
            @auth
                @if (!$isRegistered)
                    <form action="{{ route('rsvp-event', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">RSVP</button>
                    </form>
                @else
                    <div class="alert alert-success" role="alert">
                        You have already RSVP'd for this event.
                    </div>
                @endif
            @endauth
            @endif
            
        </div>
    </div>
</div>
@include('_footer')
