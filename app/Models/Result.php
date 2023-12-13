<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Competence;
use App\Models\Instructor;
class Result extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_resultado','descripcion','horas','fecha_inicio','fecha_fin','url_formato','slug','instructor_id','competence_id'];

    protected $allowIncluded=['competence','instructor','competence.datasheets'];
    protected $allowFilter = ['nombre_resultado','descripcion','horas','fecha_inicio','fecha_fin','url_formato','slug','instructor_id','competence_id'];
    protected $allowSort = ['nombre_resultado','descripcion','horas','fecha_inicio','fecha_fin','url_formato','slug','instructor_id','competence_id'];


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
         //api.adsomanager.test/v1/results?filter[nombre_resultado]=
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
         //http://api.adsomanager.test/v1/results?sort=nombre_resultado
    }
    //relacion 1 a muchos competence con result
    public function competence()
    {
        return $this->belongsTo(Competence::class, 'competence_id');
    }

    //relacion 1 a 1 result con instructor
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

}
