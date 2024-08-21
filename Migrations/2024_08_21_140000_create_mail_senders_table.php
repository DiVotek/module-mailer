<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\MailSender\Models\MailSender;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(MailSender::getDb(), function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->boolean('status')->default(false);
            $table->boolean('additional');
            $table->string('template');
            $table->json('addresses');
            $table->longText('content');
            MailSender::timestampFields($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(MailSender::getDb());
    }
};
