<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ Add this
use Illuminate\Support\Str;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'contact_email' => 'gomauristours@gmail.com',
            'whatsapp' => '+230 55040167',
            'facebook' => 'https://facebook.com/yourpage',
            'twitter' => 'https://twitter.com/yourpage',
            'instagram' => 'https://instagram.com/yourpage',
            'email_notifications_enabled' => true,
            'sms_notifications_enabled' => false,
            'notification_emails' => json_encode(['admin@yourcompany.com']),
            'notification_phones' => json_encode(['+23055040167']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
