<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Datasheet extends Model
{
    use HasFactory;
        protected $fillable = ['numero_ficha','programa','slug'];

        protected $allowIncluded=['sessions','apprentices', 'instructors', 'competences','competences.results','sessions.room','sessions.attendances'];
        protected $allowFilter = ['id','numero_ficha','programa','slug'];

        protected $allowSort = ['id','numero_ficha','programa','slug'];

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
            //api.adsomanager.test/v1/datasheets?filter[numero_ficha]=
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
             //http://api.adsomanager.test/v1/datasheets?sort=numero_ficha
        }
    //relacion 1 a muchos aprendices con datasheet
    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'ficha_id');
    }

    //relacion 1 a muchos sessions con datasheet
    public function sessions()
    {
        return $this->hasMany(Session::class, 'ficha_id');
    }

    //relacion muchs a muchos instructor
    // public function instructors()
    // {
    //     return $this->belongsToMany('App\Models\Instructor', 'datasheet_instructor', 'ficha_id', 'instructor_id');
    // }

    //relacion muchos a muchos instructor
    public function instructors()
    {
        return $this->belongsToMany(Instructor::class,'datasheet_instructor', 'ficha_id', 'instructor_id');
    }

    //relacion muchos a muchos competences con datasheets
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_datasheet', 'ficha_id', 'competencia_id');
    }

}
