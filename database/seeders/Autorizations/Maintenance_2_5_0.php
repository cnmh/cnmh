<?php

namespace Database\Seeders\Autorizations;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use League\Csv\Reader;
use League\Csv\Statement;
use Spatie\Permission\Models\Permission;

class Maintenance_2_5_0 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $now = now();

        // Read user data from CSV
        $csvFilePath = database_path('seeders/Autorizations/data/Users.csv');
        $csv = Reader::createFromPath($csvFilePath, 'r');
        $csv->setHeaderOffset(0); // assume first row as header
        $stmt = (new Statement())
            ->offset(0); // ignore the header row
        $records = $stmt->process($csv);

        // Update existing users and create new ones
        foreach ($records as $record) {
            $userData = [
                'name' => $record['name'],
                'email' => $record['email'],
                'password' => Hash::make($record['password']),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $permissions = explode(',', $record['permissions']);

            $user = User::updateOrCreate(['email' => $userData['email']], $userData);

            foreach ($permissions as $permission) {
                $permission = trim($permission);
                if (!empty($permission)) {
                    Permission::firstOrCreate(['name' => $permission]);
                    $user->givePermissionTo($permission);
                }
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
