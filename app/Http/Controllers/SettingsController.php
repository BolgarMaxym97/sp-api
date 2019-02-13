<?php

namespace App\Http\Controllers;

use App\Models\SensorSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function createOrUpdate(Request $request): array
    {
        $this->validate($request, SensorSettings::rules());
        $setting = SensorSettings::firstOrNew(['sensor_id' => $request->sensor_id]);
        return [
            'success' => $setting->fill($request->input())->save()
        ];
    }
}
