<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function registrations()
{
    return $this->hasMany(Registration::class, 'EventId'); // Adjust the foreign key if needed
}

    protected $table = 'event';
    protected $fillable = [
        'title',
        'thumbnail',
        'details',
        'venue',
        'city',
        'start_datetime',
        'end_datetime',
        'user_id',
    ];
    use HasFactory;
    public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('thumbnail');
        $table->text('details');
        $table->string('venue');
        $table->string('city');
        $table->dateTime('start_datetime');
        $table->dateTime('end_datetime');
        $table->timestamps();
    });

}

public function down()
{
    Schema::dropIfExists('events');
}

}