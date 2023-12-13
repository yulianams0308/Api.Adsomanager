<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Datasheet;

class Apprentice extends Model
{
    use HasFactory;

    protected $fillable = ['estado','etapa','slug', 'ficha_id', 'user_id'];
    protected $allowIncluded=['datasheet','user','user.role','attendance','datasheet.apprentices','datasheet.competences','datasheet.sessions'];
    protected $allowFilter=['id','estado','etapa','slug', 'ficha_id','user_id'];

    protected $allowSort=['id','estado','etapa','slug', 'ficha_id','user_id'];

//api.adsomanager.test/v1/apprentices?filter[estado]=En proceso
// api.adsomanager.test/v1/apprentices?filter[etapa]=Lectiva
// api.adsomanager.test/v1/apprentices?filter[slug]=
// api.adsomanager.test/v1/apprentices?filter[ficha_id]=
// api.adsomanager.test/v1/apprentices?filter[user_id]=

    public function scopeIncluded(Builder $query){

        if(empty($this->allowIncluded)||empty(request('included')))
        {
            return;
        }

        $relations = explode(',', request('included'));//['posts','relation2']
        $allowIncluded = collect($this->allowIncluded);//colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']

        foreach($relations as $key => $relationship)
        {
            //recorremos el array de relaciones

           if(!$allowIncluded->contains($relationship))
           {
               unset($relations[$key]);
           }

        }

       $query->with($relations);//se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included
        //api.adsomanager.test/v1/apprentices/1?included=
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
        //api.adsomanager.test/v1/apprentices?filter[estado]=
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
     //http://api.adsomanager.test/v1/apprentices?sort=ficha_id
}


    //relacion 1 a muchos ficha
    public function datasheet()
    {
        return $this->belongsTo(Datasheet::class,'ficha_id');
    }

    //Relacion uno a uno con apprentice
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relacion uno a uno con apprentice
    public function attendance()
    {
        return $this->hasOne(Attendance::class,'aprendiz_id');
    }
}
