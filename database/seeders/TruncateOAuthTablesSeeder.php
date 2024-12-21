<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruncateOAuthTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the tables
        DB::table('migrations')->truncate();
        DB::table('oauth_access_tokens')->truncate();
        DB::table('oauth_auth_codes')->truncate();
        DB::table('oauth_clients')->truncate();
        DB::table('oauth_personal_access_clients')->truncate();
        DB::table('oauth_refresh_tokens')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
