<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    //USER 
    public function users(){
        return $this->BelongsTo(User::class, "user_id");
    }
    public function costUsers(){
        return $this->BelongsTo(User::class, "additional_cost_user");
    }

}
