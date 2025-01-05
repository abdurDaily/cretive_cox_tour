<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AditionalMember extends Model
{
    public function additionalMembers()
{
    return $this->hasMany(AditionalMember::class);
}
}
