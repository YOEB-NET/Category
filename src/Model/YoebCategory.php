<?php

namespace Yoeb\Category\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoebCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'image',
        'top_category',
    ];

    function top_category_detail() {
        return $this->hasOne(YoebCategory::class, "id", "top_category")->with("top_category_detail");
    }
}
