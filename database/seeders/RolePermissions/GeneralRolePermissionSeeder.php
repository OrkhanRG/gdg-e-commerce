<?php

namespace Database\Seeders\RolePermissions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GeneralRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();

        $permissions = [
            //personal
            [
                'name'        => 'personal.profile.view',
                'description' => 'Istifadəçi profilinə baxa bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'personal.profile.edit',
                'description' => 'Istifadəçi profilin düzənləyə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'personal.password.change',
                'description' => 'Istifadəçi şifrəsin dəyişə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // Order
            [
                'name'        => 'order.view',
                'description' => 'Istifadəçi sifarişlərə baxa bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'order.cancel',
                'description' => 'Istifadəçi sifarişləri ləğv edə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'order.change-address',
                'description' => 'Istifadəçi sifarişlərin ünvanını dəyişə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            //user
            [
                'name'        => 'user.view',
                'description' => 'Istifadəçi digər istifadəçiləri baxa bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'user.create',
                'description' => 'Istifadəçi yeni istifadəçi yarada bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'user.edit',
                'description' => 'Istifadəçi digər istifadəçiləri düzənləyə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'user.delete',
                'description' => 'Istifadəçi digər istifadəçiləri silə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            //category
            [
                'name'        => 'category.view',
                'description' => 'Istifadəçi kateqoriyalara baxa bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'category.create',
                'description' => 'Istifadəçi yeni kateqoriya yarada bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'category.edit',
                'description' => 'Istifadəçi kateqoriyanı düzənləyə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'category.delete',
                'description' => 'Istifadəçi kateqoriyanı silə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            //product
            [
                'name'        => 'product.view',
                'description' => 'Istifadəçi məhsuala baxa bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'product.create',
                'description' => 'Istifadəçi yeni məhsual yarada bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'product.edit',
                'description' => 'Istifadəçi məhsulu düzənləyə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'product.delete',
                'description' => 'Istifadəçi məhsulu silə bilər.',
                'guard_name'  => 'web',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        Permission::insert($permissions);

        $superAdmin = Role::create(['name' => 'super-admin']);
        $member = Role::create(['name' => 'member']);
        $categoryManager = Role::create(['name' => 'category-manager']);
        $orderManager = Role::create(['name' => 'order-manager']);
        $productManager = Role::create(['name' => 'product-manager']);
        $userManager = Role::create(['name' => 'user-manager']);

        $superAdminPermissions = Permission::query()->get();
        $superAdmin->givePermissionTo($superAdminPermissions);

        $personalManagerPermissions = Permission::query()
            ->orWhere('name', 'LIKE', "personal.%")
            ->get();
        $member->givePermissionTo($personalManagerPermissions);

        $categoryManagerPermissions = Permission::query()
            ->where('name', 'LIKE', "category.%")
            ->orWhere('name', 'LIKE', "personal.%")
            ->get();
        $categoryManager->givePermissionTo($categoryManagerPermissions);

        $orderManagerPermissions = Permission::query()
            ->where('name', 'LIKE', "order.%")
            ->orWhere('name', 'LIKE', "personal.%")
            ->get();
        $orderManager->givePermissionTo($orderManagerPermissions);

        $productManagerPermissions = Permission::query()
            ->where('name', 'LIKE', "product.%")
            ->orWhere('name', 'LIKE', "personal.%")
            ->get();
        $productManager->givePermissionTo($productManagerPermissions);

        $userManagerPermissions = Permission::query()
            ->where('name', 'LIKE', "user.%")
            ->orWhere('name', 'LIKE', "personal.%")
            ->get();
        $userManager->givePermissionTo($userManagerPermissions);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
