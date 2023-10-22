<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $events = Event::all(); // You may want to paginate if there are many events
    return view('home', compact('events'));
})->name('home');

Route::resource('events', EventController::class);
Route::get('create-event', [EventController::class, 'create'])->name('create-event');
Route::post('store-event', [EventController::class, 'store'])->name('store-event');
Route::post('/events/{event}/rsvp', [EventController::class, 'rsvp'])->name('rsvp-event');
Route::get('/events/{event}/attendees', [EventController::class, 'showAttendees'])->name('event.attendees');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');
});
