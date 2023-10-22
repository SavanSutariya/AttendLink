@include('_header')
@include('_navigation')
<div class="container">
    <h1>Attendees</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Attendee</th>
                <th scope="col">Email</th>
                <th scope="col">RSVP Date and Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendees as $attendee)
            <tr>
                <td>{{ $attendee->name }}</td>
                <td>{{ $attendee->email }}</td>
                <td>{{ $attendee->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>