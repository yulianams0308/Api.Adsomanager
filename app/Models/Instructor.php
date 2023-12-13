<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Session;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = ['profesion','user_id','slug'];
    protected $allowIncluded=['user','user.role','user.image','datasheets', 'datasheets.apprentices','competences','sessions', 'sessions.room', 'result','attendances'];
    protected $allowFilter = ['profesion','user_id','slug'];

    protected $allowSort = ['profesion','user_id','slug'];

// user,user.role,user.image,datasheets,datasheets.apprentices,competences,sessions, sessions.room, result,attendances
     public function scopeIncluded(Builder $query)
     {

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
         //api.adsomanager.test/v1/instructors?filter[profesion]=
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
         //http://api.adsomanager.test/v1/instructors?sort=profesion
    }


    //relacion muchos a muchos datasheets con instructor
    public function datasheets()
    {
        return $this->belongsToMany(Datasheet::class, 'datasheet_instructor', 'ficha_id', 'instructor_id');
    }

    //relacion 1 a 1 instructor
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //relacion 1 a muchos session con instructor
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    //relacion 1 a muchos competences con instructor
    public function competences()
    {
        return $this->hasMany(Competence::class, 'instructor_id');
    }

    //relacion 1 a 1 result con instructor
    public function result()
    {
        return $this->hasOne(Result::class, 'instructor_id');
    }

    //relacion 1 a muchos attendances con instructor
    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, Session::class, 'instructor_id', 'session_id');
    }
        //relacion muchos a muchos datasheets con instructor
    // public function datasheets()
    // {
    //     return $this->belongsToMany('App\Models\Datasheet', 'datasheet_instructor', 'instructor_id', 'ficha_id');
    // }
}
