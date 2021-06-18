<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function registry()
    {
        return $this->belongsTo(Registry::class);
    }


    protected $fillable = [
        'name',
        'surname',
        'number',
        'expiration',
        'cvc',
        'registry_id'
    ];
}
