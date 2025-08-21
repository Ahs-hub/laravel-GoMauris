<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // 🔹 Social links
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            // 🔹 Main site contact
            $table->string('contact_email')->nullable();   // main email shown on site

            // 🔹 Notifications
            $table->boolean('email_notifications_enabled')->default(true);
            $table->boolean('sms_notifications_enabled')->default(false);

            // Store multiple emails/phones as JSON
            $table->json('notification_emails')->nullable();  
            $table->json('notification_phones')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
