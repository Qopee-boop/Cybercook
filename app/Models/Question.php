<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    protected $fillable = ['module_id','type','difficulty','stem','options','answer','explanation','is_active'];
    protected $casts = [
    'options' => 'array',
    'answer'  => 'array',
    'is_active' => 'boolean',
    ];
    public function module(){ return $this->belongsTo(Module::class); }
}

