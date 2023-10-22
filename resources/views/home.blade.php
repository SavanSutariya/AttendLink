@include('_header')
@include('_navigation')
<div class="container">
    <h1>Events</h1>
    <div class="row">
        @foreach($events as $event)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $event->thumbnail) }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('_footer')