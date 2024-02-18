<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    # Definimos la relación muchos a uno (un post va tener un usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['name', 'username']);
    }

    # Definimos la relación uno a muchos(un post va tener muchos comentarios)
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
