<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;

    // Velden die je mass-assignable wil maken
    protected $fillable = [
        'user_id',
        'skills',
        'experience',
        'availability',
    ];

    // Skills automatisch als array casten
    protected $casts = [
        'skills' => 'array',
    ];

    // Relatie naar User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
