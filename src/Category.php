<?php

// 05.10.2023 YOEB.NET X BERKAY.ME

namespace Yoeb\Category;

use Yoeb\Category\Model\YoebCategory;

class Category{

    // Add
    protected static $name = null;
    protected static $description = null;
    protected static $icon = null;
    protected static $image = null;
    protected static $topCategory = null;
    protected static $paginate = 0;
    protected static $filter = null;

    public static function name($name){
        self::$name = $name;
        return (new static);
    }

    public static function description($description){
        self::$description = $description;
        return (new static);
    }

    public static function icon($icon){
        self::$icon = $icon;
        return (new static);
    }

    public static function image($image){
        self::$image = $image;
        return (new static);
    }

    public static function topCategory($topCategory){
        self::$topCategory = $topCategory;
        return (new static);
    }

    public static function paginate($paginate = 10)
    {
        self::$paginate = $paginate;
        return (new static);
    }

    public static function filter($filter) {
        self::$filter = $filter;
        return (new static);
    }

    public static function add() {
        self::create([
            "name"          => self::$name,
            "description"   => self::$description,
            "icon"          => self::$icon,
            "image"         => self::$image,
            "top_category"  => self::$topCategory,
        ]);
    }

    public static function create($data) {
        $res = YoebCategory::create($data);
        self::reset();
        return $res;
    }

    public static function baseQuery() {
        $query = YoebCategory::query();

        if (!empty(self::$name)) {
            $query = $query->where("name", self::$name);
        }
        if (!empty(self::$description)) {
            $query = $query->where("description", self::$description);
        }
        if (!empty(self::$icon)) {
            $query = $query->where("icon", self::$icon);
        }
        if (!empty(self::$image)) {
            $query = $query->where("image", self::$image);
        }
        if (!empty(self::$topCategory)) {
            $query = $query->where("topCategory", self::$topCategory);
        }

        return $query;
    }

    // List
    public static function list($query = null) {
        $list = self::baseQuery();
        if (is_callable($query)) {
            $query($list);
        }

        if(self::$paginate){
            if(empty(self::$filter)){
                $data = $list->paginate(self::$paginate);
            }else{
                $data = $list->paginate(self::$paginate, self::$filter);
            }
        }else{
            if(empty(self::$filter)){
                $data = $list->get();
            }else{
                $data = $list->get(self::$filter);
            }
        }

        self::reset();

        return $data;
    }

    // Delete
    public static function delete(){
        $delete = self::baseQuery();
        $delete->forceDelete();
        return $delete;
    }

    public static function softDelete(){
        $delete = self::baseQuery();
        $delete->delete();
        return $delete;
    }

    public static function reset() {
        self::$name          = null;
        self::$description   = null;
        self::$icon          = null;
        self::$image         = null;
        self::$topCategory   = null;
    }

}

?>

