<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    # Realación inversa (este comentario pertenece a un usuario)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
