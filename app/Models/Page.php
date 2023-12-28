<?php

namespace App\Models;

use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Dotlogics\Grapesjs\App\Contracts\Editable;
class Page extends Model implements Editable
{
    use HasFactory,HasTranslations,EditableTrait;
    protected $connection = 'website';

    public $translatable = ['name','gjs_data'];
    // public $translatable = ['name'];
    protected $guarded=['id'];
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }
    public function getEnglishNameAttribute()
{
    return $this->getTranslations('name')['en'];
}
}
