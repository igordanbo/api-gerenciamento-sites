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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('url', 255);

            $table->enum('status', [
                'active',
                'inactive',
                'canceled',
                'lost_domain',
                'frozen_domain',
                'maintenance'
            ])->default('inactive');

            $table->enum('hosting', [
                'laon',
                'external',
            ])->default('laon');

            $table->enum('department', [
                'laon',
                'wordpress',
                'opencart',
                'outros'
            ])->default('laon');

            $table->enum('service', [
                'site',
                'email',
                'sistema',
                'site_email',
                'site_sistema',
                'sistema_email',
                'site_email_sistema'
            ])->default('site');

            $table->string('cnpj')->nullable();
            $table->text('adicional_info')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
