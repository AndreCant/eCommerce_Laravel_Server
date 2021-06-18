<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected $fillable = [
        'name',
        'surname',
        'street',
        "city",
        "county",
        "postal_code",
        "state",
        "phone",
        "user_id"
    ];
}
