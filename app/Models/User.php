<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }


    public function isAdmin(){

        return $this->roles()->where('name','ADMINISTRATEUR')->first()  || $this->id === 1;
    }

    public function isControleur(){
        return $this->roles()->where('name', 'CONTROLLEUR')->first();
    }

    public function isComptable(){
        return $this->roles()->where('name', 'COMPTABLE')->first();
    }

    public function isVente(){
        return $this->roles()->where('name', 'VENTE')->first();
    }

    public function isEntreProduit(){
        return $this->roles()->where('name', 'ENTRE DES PRODUITS EN STOCK')->first();
    }




}
