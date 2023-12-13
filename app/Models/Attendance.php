<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Session;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['asistio', 'slug', 'sesion_id','aprendiz_id'];
    protected $allowIncluded=['instructor','session','apprentice'];
    protected $allowFilter = ['id','asistio','instructor_id','session_id','session_id','aprendiz_id'];
    protected $allowSort = ['id','asistio','instructor_id','session_id','session_id','aprendiz_id'];

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
        //api.adsomanager.test/v1/attendances?filter[asistio]=
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
         //http://api.adsomanager.test/v1/attendances?sort=session_id
    }

    // //Relacion Uno a Uno sesion
    // public function session()
    // {
    //     return $this->belongsTo(Session::class);
    // }

    // //Relacion uno a uno con attendance
    // public function apprentice()
    // {
    //     return $this->hasOne(Apprentice::class);
    // }

    //Relacion uno a uno con attendance
    public function instructor()
    {
        return $this->belongsTo(Instructor::class,'instructor_id');
    }

    //Relacion uno a uno con session con attendance
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    //Relacion uno a uno con attendance
    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class, 'aprendiz_id');
    }
}
