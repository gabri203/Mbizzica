<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Paste extends Model
{
    //
    protected $fillable = [
        'slug',
        'content',
        'expires_at',
    ];

     // Qui dico a Eloquent di trasformare expires_at in Carbon gli oggetti stringa in datetime
     protected $casts = [
        'expires_at' => 'datetime',
    ];

    //ho eliminato protected $dates perchè entra il conflitto con $dates nuove versioni di laravel
    /*protected $dates = [
        'expires_at',
        'created_at',
        'updated_at',
    ];*/

    public static function booted()
    {
        parent::boot();

        static::creating(function($paste){
            //mi genera uno slug di 8 caratteri
            $paste->slug = Str::random(8);//@Todo
        });
    }
}
