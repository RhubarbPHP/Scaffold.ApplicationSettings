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

namespace Rhubarb\Scaffolds\ApplicationSettings\Models;

use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\AutoIncrement;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MediumText;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\Varchar;
use Rhubarb\Stem\Repositories\MySql\Schema\Index;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlSchema;

class ApplicationSetting extends Model
{
    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new MySqlSchema("tblApplicationSetting");
        $schema->addColumn(
            new AutoIncrement("ApplicationSettingID"),
            new Varchar("SettingName", 30),
            new MediumText("SettingValue")
        );

        $schema->addIndex(new Index("SettingName", Index::UNIQUE, ["SettingName"]));

        return $schema;
    }

    /**
     * Finds a setting entry by it's setting name.
     *
     * @param $settingName string The name of the setting the fetch.
     * @return Model
     * @throws RecordNotFoundException
     */
    public static function findBySettingName($settingName)
    {
        return self::findLast(new Equals("SettingName", $settingName));
    }

    /**
     * Returns the existing entry for a given setting name or creates a new (but unsaved) model if
     * one could not be found.
     *
     * @param string $settingName The name of the setting to find
     * @return ApplicationSetting|Model
     */
    public static function findOrCreateBySettingName($settingName)
    {
        try {
            return self::findBySettingName($settingName);
        } catch (RecordNotFoundException $er) {
            $setting = new self();
            $setting->SettingName = $settingName;

            return $setting;
        }
    }
}