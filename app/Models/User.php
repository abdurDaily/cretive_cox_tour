<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public function additinalMembers(){
        return $this->hasMany(AditionalMember::class);
    }


    // TRANSACTION 
    public function transactions(){
        return $this->hasMany(Transaction::class, 'additional_cost_user');
    }

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
        'phone',
        // 'tshirt_size',
        'opinion',
        'is_going',
        // 'couple_room',
        // 'single_room',


        'm_size',
        'l_size',
        'xl_size',
        'xxl_size',
        'single_room',
        'couple_room',
        'additional_members'
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



    
}
