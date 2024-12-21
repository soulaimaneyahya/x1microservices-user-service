<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InsertMigrationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $migrationsPath = database_path('migrations');
        $migrationFiles = File::files($migrationsPath);

        $data = [];

        foreach ($migrationFiles as $file) {
            $migrationName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

            $data[] = [
                'migration' => $migrationName,
                'batch' => 1
            ];
        }

        // Insert data into the migrations table
        DB::table('migrations')->insert($data);
    }
}
