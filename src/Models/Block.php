<?php

namespace GMJ\LaravelBlock2Content\Models;

use App\Traits\DeleteAllChildrenTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Block extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;
    use DeleteAllChildrenTrait;

    protected $guarded = [];
    protected $table = "laravel_block2_contents";
    public $translatable = ['text'];
}
