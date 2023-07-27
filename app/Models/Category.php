<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable =[
        'category_number',
        'name', 
        'level'
    ];

    /**
     * Category has many to Question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Question has many to DataSet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataSet()
    {
        return $this->hasMany(DataSet::class);
    }
}
