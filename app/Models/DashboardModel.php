<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardModel extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'created_at',
        'updated_at'
    ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }
}
