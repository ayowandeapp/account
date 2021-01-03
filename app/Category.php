<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name'];

    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }


}
