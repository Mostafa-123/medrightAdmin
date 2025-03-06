<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RequestHiring extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $connection = 'website';

    protected $guarded=['id'];

    public function position(){
        return $this->belongsTo(Position::class,'position_id');
    }

    public function level(){
        return $this->belongsTo(Level::class,'level_id');
    }
    public function registerMediaCollections(): void
{
    $this->addMediaCollection('requests_personal_images');

    $this->addMediaCollection('requests_personal_cvs');
}

    public function registerMediaConversions(Media $media = null): void
{
    $this
        ->addMediaConversion('preview')
        ->fit(Manipulations::FIT_CROP, 300, 300)
        ->nonQueued();
}
}
