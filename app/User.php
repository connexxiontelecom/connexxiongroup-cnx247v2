<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    /*
    * Each experience belongs to a user
    */
    public function experience(){
        $this->hasMany(Experience::class);
    }

    //tenant-user relationship
    public function tenant(){
        //1. tenant_id on users table
        //2. tenant_id on tenants table
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }

 /*    public function leaveWallet(){
        return $this->belongsTo(LeaveWallet::class);
    } */


    //Mutator
/*     public function setVerificationLinkAttribute($value){
        $value = substr(sha1(time()), 5,15); //override value
        $this->attributes['verification_link'] = $value;
    } */
}
