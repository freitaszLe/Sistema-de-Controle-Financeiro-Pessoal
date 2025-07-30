<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {   // Define uma ação a ser executada APÓS um novo usuário ser criado
        static::created(function (User $user) {
            // Cria um perfil associado a este usuário
            $user->profile()->create();
        });
    }

    public function profile()
    {
        // Um Usuário tem um Perfil
        return $this->hasOne(UserProfile::class);
    }

    public function accounts()
    {
        // Um Usuário pode ter várias Contas
        return $this->hasMany(Account::class);
    }
    public function categories()
    {
        // Um Usuário pode ter várias Categorias
        return $this->hasMany(Category::class);
    }
}
