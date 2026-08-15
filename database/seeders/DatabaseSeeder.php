<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferralPointSetting;
use App\Models\DocumentType;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call other seeders
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
            WebsiteContentSeeder::class,
            WebsiteMediaSeeder::class,
            CmsPageSeeder::class,
            FaqSeeder::class,
            CustomerPortalSeeder::class,
        ]);

        // Seed default referral point setting rules
        ReferralPointSetting::updateOrCreate(
            ['title' => 'Referral Reward Credit'],
            [
                'type' => 'Credit',
                'amount' => 500.00
            ]
        );
        ReferralPointSetting::updateOrCreate(
            ['title' => 'Manual adjustment credit'],
            [
                'type' => 'Credit',
                'amount' => 100.00
            ]
        );
        ReferralPointSetting::updateOrCreate(
            ['title' => 'Manual adjustment debit'],
            [
                'type' => 'Debit',
                'amount' => 50.00
            ]
        );

        // Seed default document types
        foreach (['Panel Warranty', 'Inverter Warranty', 'Installation Agreement', 'Net-Metering Approval', 'Invoice', 'Other'] as $type) {
            DocumentType::updateOrCreate(
                ['title' => $type],
                ['status' => 1]
            );
        }

        // Create Custom Admin User
        $email = 'admin2026@aesenergy.in';
        $password = 'AESAdmin@2026#';

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'AES Executive Admin',
                'password' => bcrypt($password),
                'user_type' => 'admin',
                'status' => 1,
            ]
        );

        $role = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $user->assignRole($role);
    }
}
