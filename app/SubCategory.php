<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['sub_cat_name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'sub_category_id');
    }
}