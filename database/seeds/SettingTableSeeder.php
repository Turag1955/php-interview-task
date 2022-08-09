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
        $settingArray['site_phone_number']        = '+8801778888';
        $settingArray['site_logo']                = 'site_logo.png';
        $settingArray['site_footer']              = '@ All Rights Reserved';
        $settingArray['site_address']             = 'Dhaka, Bangladesh.';
        $settingArray['site_description']         = 'news post';
        $settingArray['terms_condition']          = 'Terms condition';

        $settingArray['timezone']           = '';
        $settingArray['mail_host']          = '';
        $settingArray['mail_port']          = '';
        $settingArray['mail_username']      = '';
        $settingArray['mail_password']      = '';
        $settingArray['mail_from_name']     = '';
        $settingArray['mail_from_address']  = '';
        $settingArray['mail_disabled']      = 1;
        $settingArray['locale']             = 'en';

        SeederSetting::set($settingArray);
        SeederSetting::save();
    }
}
