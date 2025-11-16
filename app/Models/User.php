<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users_232136';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name_232136',
        'email_232136',
        'password_232136',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password_232136',
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
            'email_verified_at_232136' => 'datetime',
            'password_232136' => 'hashed',
        ];
    }

    // Override the authentication column names
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthPassword()
    {
        return $this->password_232136;
    }

    public function getEmailForPasswordReset()
    {
        return $this->email_232136;
    }

    // Specify the username field for authentication
    public function username()
    {
        return 'email_232136';
    }

    // Relationships
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id_232136');
    }

    public function favoriteDestinations()
    {
        return $this->belongsToMany(Destination::class, 'favorites_232136', 'user_id_232136', 'destination_id_232136')
                    ->withTimestamps();
    }
}
