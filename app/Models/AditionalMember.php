<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AditionalMember extends Model
{
    public function users(){
        return $this->belongsTo(User::class, 'user_id'); // Replace 'user_id' with the actual foreign key column name in the `aditional_members` table.
    }

    
    public function transaction(){
        return $this->hasMany(Transaction::class); // Replace 'user_id' with the actual foreign key column name in the `aditional_members` table.
    }


}
