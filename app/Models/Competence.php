<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Competence extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_competencia','descripcion','anexo','slug',];

    protected $allowIncluded=['instructor','results','datasheets','datasheets.sessions','datasheets.apprentices'];
    protected $allowFilter = ['id','nombre_competencia','descripcion','anexo','instructor_id','slug'];
    protected $allowSort = ['id','nombre_competencia','descripcion','anexo','instructor_id','slug'];


    //  public function scopeIncluded(Builder $query){

    //      if(empty($this->allowIncluded)||empty(request('included'))){
    //          return;
    //      }

    //      $relations = explode(',', request('included'));//['posts','relation2']



    //      $allowIncluded = collect($this->allowIncluded);//colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']

    //      foreach($relations as $key => $relationship)
    //      {//recorremos el array de relaciones

    //         if(!$allowIncluded->contains($relationship))
    //         {
    //             unset($relations[$key]);
    //         }

    //      }

    //     $query->with($relations);//se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included

    //  }
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return $query;
        }

        $requestedRelations = explode(',', request('included'));

        $allowedRelations = collect($this->allowIncluded);

        $includedRelations = $allowedRelations->filter(function ($relationship) use ($requestedRelations) {
            return in_array($relationship, $requestedRelations);
        })->toArray();

        return $query->with($includedRelations);
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
        //api.adsomanager.test/v1/competences?filter[nombre_competencia]=
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
         //http://api.adsomanager.test/v1/competences?sort=nombre_competencia
    }
    //relacion 1 a muchos competence con results
    public function results()
    {
        return $this->hasMany(Result::class, 'competence_id');
    }

    //Relacion muchos a muchos datasheets con competences
    public function datasheets()
    {
        return $this->belongsToMany(Datasheet::class, 'competence_datasheet', 'competencia_id', 'ficha_id');
    }

    //relacion 1 a muchos instructor con competences
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

}
