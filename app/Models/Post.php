<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];    
    protected $with = ['category', 'author'];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopefilter($query, array $filters ){
    
        if($filters['search'] ?? false){
            $query
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
            
        }
         

        $query->when($filters['category'] ?? false, fn($query, $category) =>
        
        $query->whereHas('category', fn($query) => $query->where('slug',$category)));
            
      
    
    
        $query->when($filters['author'] ?? false, fn($query, $author) =>
        
        $query->whereHas('username', fn($query) => $query->where('slug',$author)));
            
        }
    
    }
    


            

    


