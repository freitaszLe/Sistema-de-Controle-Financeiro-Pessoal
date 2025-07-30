<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'birth_date',
        'cpf',
        'nationality',
        'postal_code',
        'gender',
        'marital_status',
    ];


    public function user()
    {   //um Perfil pertence a um Usuário
        return $this->belongsTo(User::class);
    }
}
