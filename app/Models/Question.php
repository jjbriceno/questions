<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable =[
        'category_id',
        'question_name', 
        'answers_options',
        'answer'
    ];

    /**
     * Question belongsTo to Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Question has many to DataSet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataSet()
    {
        return $this->hasMany(DataSet::class);
    }

}
