<?php

use Illuminate\Database\Seeder;
use Setting as SeederSetting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settingArray['site_name']                = 'NewsPost';
        $settingArray['site_email']               = 'info@newspost.xyz';

        SeederSetting::set($settingArray);
        SeederSetting::save();
    }
}
