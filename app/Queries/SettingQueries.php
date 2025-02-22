<?php

namespace App\Queries;

use App\Models\Setting;

/**
 * Class SettingsQueries
 *
 * Query class for handling operations related to the SettingsModel.
 */
class SettingQueries
{
    /**
     * Get all settings.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Setting::all();
    }

    public static function getSettingValue(string $key)
    {
        return Setting::where('key', $key)->get()->last()->value;
    }
}
