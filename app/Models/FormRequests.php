<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormRequests extends Model
{
    use HasFactory,SoftDeletes;
    protected $connection = 'website';
    protected $guarded=['id'];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
    public function field()
    {
        return $this->belongsTo(FormFields::class, 'field_id');
    }
}
