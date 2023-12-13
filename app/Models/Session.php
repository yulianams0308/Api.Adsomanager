<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\Datasheet;
use App\Models\Instructor;
use App\Models\Room;

use Illuminate\Database\Eloquent\Builder;
class Session extends Model
{
    use HasFactory;

    protected $fillable = ['observacion','fecha_inicio','fecha_fin','ficha_id','ambiente_id'];


    protected $allowIncluded=['instructor','room','attendances', 'datasheet','datasheet.apprentices','datasheet.competences'];
    protected $allowFilter = ['observacion','fecha_inicio','fecha_fin','ficha_id','ambiente_id'];
    protected $allowSort = ['observacion','fecha_inicio','fecha_fin','ficha_id','ambiente_id'];

    public function scopeIncluded(Builder $query)
    {
         if(empty($this->allowIncluded)||empty(request('included')))
         {
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
         //api.adsomanager.test/v1/sessions?filter[observacion]=
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
         //http://api.adsomanager.test/v1/sessions?sort=observacion
    }

    // //Relacion Uno a Uno asistencia
    // public function attendance()
    // {
    //     return $this->hasOne(Attendance::class, 'session_id');
    // }

    //relacion 1 a muchos datasheet con session
    public function datasheet()
    {
        return $this->belongsTo(Datasheet::class, 'ficha_id');
    }

    //Relacion Uno a muchos instructor con session
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    //Relacion Uno a Uno room con session
    public function room()
    {
        return $this->belongsTo(Room::class,'ambiente_id');
    }

    // //Relacion Uno a Uno instructor con session
    // public function instructor()
    // {
    //     return $this->hasOne(Instructor::class, 'id', 'instructor_id');
    // }
}
