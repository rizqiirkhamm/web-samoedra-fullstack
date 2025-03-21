<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

        protected $table = 'roles';

        static public function getSingle($id){
            return RoleModel::find($id);
        }

        static public function getRecord(){
            return RoleModel::get();
        }

        
}
