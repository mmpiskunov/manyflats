<?php

namespace App\Services\Data;

use App\Models\Property;
use Carbon\Carbon;

class DataBaseService
{
    /**
     * Clean old data from property table
     */
    public function cleanOldData()
    {
        $expirationDate = Carbon::now()->subDay();
        Property::where('updated_at', '<', $expirationDate)->delete();
    }
}
