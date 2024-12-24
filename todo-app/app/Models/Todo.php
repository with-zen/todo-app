<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'completed',
    ];

    /**
     * The validation rules for creating or updating a Todo.
     *
     * @return array
     */
    public static function validationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'completed' => 'boolean',
        ];
    }
}
