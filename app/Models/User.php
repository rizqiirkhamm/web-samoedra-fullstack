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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public static function getRecord(){
        return User::select('users.*', 'roles.name as role_name')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->orderBy('users.id', 'desc')
        ->get();
    }
    static public function getSingle($id){
        return self::find($id);
    }

    public function role()
    {
        // 'role_id' = nama kolom di tabel 'users'
        // 'id' = primary key di tabel 'roles'
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }
}
