<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Scaffolds\ApplicationSettings\Settings;

require_once __DIR__ . '/../Models/ApplicationSetting.php';
require_once __DIR__ . '/../../../rhubarb/src/Settings.php';

use Rhubarb\Crown\Settings;
use Rhubarb\Scaffolds\ApplicationSettings\Models\ApplicationSetting;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;

class ApplicationSettings extends Settings
{
    public function __set($propertyName, $value)
    {
        parent::__set($propertyName, $value);

        $setting = ApplicationSetting::findOrCreateBySettingName($propertyName);
        $setting->SettingValue = $value;
        $setting->save();
    }

    public function __get($propertyName)
    {
        try {
            $setting = ApplicationSetting::findBySettingName($propertyName);
            return $setting->SettingValue;
        } catch( RecordNotFoundException $er){
            return null;
        }
    }
}
