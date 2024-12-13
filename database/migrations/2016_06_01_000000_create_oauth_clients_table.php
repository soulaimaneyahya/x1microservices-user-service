<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Get the migration connection name.
     *
     * @return string|null
     */
    public function getConnection()
    {
        return config('passport.storage.database.connection');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->foreignUuid('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
                ->onDelete('cascade');
            $table->string('name', 255);
            $table->string('description', 500)->nullable();
            $table->string('secret', 100)->nullable();
            $table->string('provider')->nullable();
            $table->string('homepage_url', 255);
            $table->string('callback_url', 255);
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oauth_clients');
    }
};
