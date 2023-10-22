@include('_header')
@include('_navigation')
<div class="container">
    <h1>Create Event</h1>

    <form action="{{ route('store-event') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (Image)</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Venue</label>
            <input type="text" class="form-control" id="venue" name="venue" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>

        <div class="mb-3">
            <label for="start_datetime" class="form-label">Start Date and Time</label>
            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
        </div>

        <div class="mb-3">
            <label for="end_datetime" class="form-label">End Date and Time</label>
            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@include('_footer')