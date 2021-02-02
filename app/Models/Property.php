<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    public const
        TABLE_NAME = 'properties',
        ADDING_RULES = ['house' => 'required|max:10'],
        EDITING_RULES = ['house' => 'required|max:50'],
        RULE_TRANSLATION = ['house.required' => 'House number is required'],
        REQUIRED = ['price', 'price2m'],
        MONEY = ['price', 'price2m', 'rent', 'rent2m'],
        SPACE = ['space'],
        PERCENTAGE = ['profit'],
        YEARS = ['payback'];

    protected $table = 'properties';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $hidden = ['link'];

    /**
     * Get district
     *
     * @param $item
     * @return string
     */
    public function getDistrict($item): string
    {
        is_array($item) ?: $item = $item->toArray();
        return $item['country'] . ', ' . $item['city'] . ', ' . $item['district'];
    }

    /**
     * Get address
     *
     * @param $item
     * @return string
     */
    public function getAddress($item): string
    {
        is_array($item) ?: $item = $item->toArray();
        return trans('countries.name.' . $item['country']) . ' / ' . trans('feeds/districts.city.' . $item['city'] . '.name') . ' / ' . trans('feeds/districts.city.' . $item['city'] . '.' . $item['district']); // $item['street'] . ' ' . $item['house'];
    }
}
