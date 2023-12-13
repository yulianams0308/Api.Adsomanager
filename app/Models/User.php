<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Apprentice;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password','role_id'
    ];
    protected $allowIncluded=['instructor','role','image', 'apprentice'];
    protected $allowFilter = [
        'name',
        'email',
        'password','role_id'
    ];

    protected $allowSort = [
        'name',
        'email',
        'password','role_id'
    ];



     public function scopeIncluded(Builder $query){

         if(empty($this->allowIncluded)||empty(request('included'))){
             return;
         }

         $relations = explode(',', request('included'));//['posts','relation2']



         $allowIncluded = collect($this->allowIncluded);//colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']

         foreach($relations as $key => $relationship)
         {//recorremos el array de relaciones

            if(!$allowIncluded->contains($relationship))
            {
                unset($relations[$key]);
            }

         }

        $query->with($relations);//se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included

     }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function scopeFilter(Builder $query)
    {
        if(empty($this->allowFilter)||empty(request('filter')))
        {
            return;
        }

        $filters=request('filter');
        $allowFilter= collect($this->allowFilter);

        foreach($filters as $filter => $value)
        {
            if($allowFilter->contains($filter))
            {
                $query->where($filter,'LIKE', '%'.$value.'%');
            }
        }
        //api.adsomanager.test/v1/users?filter[name]=
    }
    public function scopeSort(Builder $query){
    
        if(empty($this->allowSort)||empty(request('sort')))
        {
            return;
        }
        
        
        $sortFields = explode(',', request('sort'));
        $allowSort= collect($this->allowSort);
    
        foreach($sortFields as $sortField )
        {
    
            if($allowSort->contains($sortField))
            {
                $query->orderBy($sortField,'asc');
            }
        }
         //http://api.adsomanager.test/v1/users?sort=name
    }
    // //relacion 1 a 1 images con user
    // public function image()
    // {
    //     return $this->hasOne(Image::class, 'user_id');
    // }

    //relacion 1 a muchos roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //Relacion uno a uno polimorfica image
    public function image()
    {
        return $this->morphOne('App\Models\Image','imageable');
    }

    //Relacion uno a uno apprentice con user
    public function apprentice()
    {
        return $this->hasOne(Apprentice::class, 'user_id');
    }

    //Relacion uno a uno instructor con user
    public function instructor()
    {
        return $this->hasOne(instructor::class, 'user_id');
    }
}
