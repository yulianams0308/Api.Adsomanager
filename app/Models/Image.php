<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url','imageable_type','slug','imageable_id','user_id'];
    protected $guarded = [];
    protected $allowIncluded=['user'];
    protected $allowFilter = ['url','imageable_type','imageable_id','user_id'];
    protected $allowSort = ['url','imageable_type','imageable_id','user_id'];


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
         //api.adsomanager.test/v1/iamges?filter[url]=
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
         //http://api.adsomanager.test/v1/images?sort=url
    }

    public function imageable()
    {
        return $this->morphTo();
    }

    //relacion 1 a 1 images con user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
