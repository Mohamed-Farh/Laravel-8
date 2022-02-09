<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $superAdminRole     = Role::create(['name' => 'superAdmin',  'display_name' => 'Administrator',  'description' => 'System Administrator', 'allowed_route' => 'admin']);
        $adminRole          = Role::create(['name' => 'admin',       'display_name' => 'admin',          'description' => 'System Admin',         'allowed_route' => 'admin']);
        $userRole           = Role::create(['name' => 'user',        'display_name' => 'User',           'description' => 'System User',          'allowed_route' => 'admin']);
        $customerRole       = Role::create(['name' => 'customer',    'display_name' => 'Customer',       'description' => 'Website Customer',     'allowed_route' => null   ]);

        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'System Administrator',
            'email' => 'superAdmin@superAdmin.com',
            'mobile' => '01234567890',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'user_image'=>'images/user/avatar.png',
            'remember_token' => Str::random(10),
        ]);
        $superAdmin->attachRole($superAdminRole);


        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'username' => 'System Admin',
            'email' => 'admin@admin.com',
            'mobile' => '01234567880',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'user_image'=>'images/user/avatar.png',
            'remember_token' => Str::random(10),
        ]);
        $admin->attachRole($adminRole);


        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'System',
            'username' => 'System User',
            'email' => 'user@user.com',
            'mobile' => '01234567800',
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
            'user_image'=>'images/user/avatar.png',
            'remember_token' => Str::random(10),
        ]);
        $user->attachRole($userRole);


        $user1 = User::create([ 'first_name' => 'Customer', 'last_name' => 'Customer', 'username' => 'Customer Customer', 'email' => 'customer@customer.com',  'mobile' => '01234567999','status'=> 1, 'password' => bcrypt('password'),'email_verified_at' => Carbon::now(), 'user_image'=>'images/customer/avatar.png', 'remember_token' => Str::random(10), ]);
        $user1->attachRole($customerRole);

        $user2 = User::create(['first_name' => 'Mohamed',   'last_name' => 'Farh',     'username' => 'Mohamed Farh',     'email' => 'mohamed@yahoo.com', 'mobile' => '01234567799','status'=> 1, 'password' => bcrypt('password'),'email_verified_at' => Carbon::now(), 'user_image'=>'images/customer/avatar.png', 'remember_token' => Str::random(10), ]);
        $user2->attachRole($customerRole);

        $user3 = User::create(['first_name' => 'Ahmed',     'last_name' => 'Farh',     'username' => 'Ahmed Farh',       'email' => 'ahmed@yahoo.com',       'mobile' => '01234567699','status'=> 1, 'password' => bcrypt('password'),'email_verified_at' => Carbon::now(), 'user_image'=>'images/customer/avatar.png', 'remember_token' => Str::random(10), ]);
        $user3->attachRole($customerRole);

        for ($i = 0; $i <10; $i++) {
            $user_i = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->email,
                'mobile' => '9665' . random_int(10000000, 99999999),
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('password'),
                'user_image'=>'images/customer/avatar.png',
                'status'=> 1,
                'remember_token' => Str::random(10),
            ]);
            $user_i->attachRole($customerRole);
        }





        // MAIN
        $manageMain = Permission::create([
            'name' => 'main',                           //اسم الصلاحية اللي هعملها
            'display_name' => 'Main Dashboard',                   //الاسم اللي هيظهر عند اختيارها
            'description' => 'Administrator Dashboard', //وصف لهذة الصلاحية
            'route' => 'index',                         //الراوت اللي هيووصلني بيه
            'module' => 'index',                        //كيفية الوصول اليها او الراوت بتاعها
            'as' => 'index',                            //
            'icon' => 'fa fa-home',                     //اللي هتظهر قبلها
            'parent' => '0',                            //
            'parent_original' => '0',                   //
            'sidebar_link' => '1',                      //هيكون موجود في السايدبار
            'appear' => '1',                            //هيكون ظاهر و لا مخفي
            'ordering' => '1',                          //اول لينك هيظهر في السايدبار
        ]);
        $manageMain->parent_show = $manageMain->id;     //هنا هحط الايدي يتاع الروول في متغير لاستخدامه بعد ذلك
        $manageMain->save();




        //Categories
        $manageCategories = Permission::create([ 'name' => 'manage_categories', 'display_name' => 'Categories', 'route' => 'categories', 'module' => 'categories', 'as' => 'categories.index', 'icon' => 'fas fa-th-large', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '5', ]);
        $manageCategories->parent_show = $manageCategories->id;
        $manageCategories->save();
        $showCategories    = Permission::create([ 'name' => 'show_categories',          'display_name' => 'Categories',              'route' => 'categories.index',         'module' => 'categories', 'as' => 'categories.index',       'icon' => 'fas fa-th',           'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createCategories  = Permission::create([ 'name' => 'create_categories',        'display_name' => 'Create Categories',       'route' => 'categories.create',        'module' => 'categories', 'as' => 'categories.create',      'icon' => null,                  'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateCategories  = Permission::create([ 'name' => 'update_categories',        'display_name' => 'Update Categories',       'route' => 'categories.edit',          'module' => 'categories', 'as' => 'categories.edit',        'icon' => null,                  'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyCategories = Permission::create([ 'name' => 'delete_categories',        'display_name' => 'Delete Categories',       'route' => 'categories.destroy',       'module' => 'categories', 'as' => 'categories.destroy',     'icon' => null,                  'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '0', ]);
        // ##Tags##
        // $showTags     = Permission::create([ 'name' => 'show_tags',         'display_name' => 'Tags',               'route' => 'tags.index',        'module' => 'categories', 'as' => 'tags.index',       'icon' => 'fas fa-tags',         'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '1', ]);
        // $createTags   = Permission::create([ 'name' => 'create_tags',       'display_name' => 'Create Tags',        'route' => 'tags.create',       'module' => 'categories', 'as' => 'tags.create',      'icon' => null,                  'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '0', ]);
        // $updateTags   = Permission::create([ 'name' => 'update_tags',       'display_name' => 'Update Tags',        'route' => 'tags.edit',         'module' => 'categories', 'as' => 'tags.edit',        'icon' => null,                  'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '0', ]);
        // $destroyTags  = Permission::create([ 'name' => 'delete_tags',       'display_name' => 'Delete Tags',        'route' => 'tags.destroy',      'module' => 'categories', 'as' => 'tags.destroy',     'icon' => null,                  'parent' => $manageCategories->id, 'parent_show' => $manageCategories->id, 'parent_original' => $manageCategories->id,'sidebar_link' => '1', 'appear' => '0', ]);

        //Tags
        $manageTags = Permission::create([ 'name' => 'manage_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '10', ]);
        $manageTags->parent_show = $manageTags->id;
        $manageTags->save();
        $showTags     = Permission::create([ 'name' => 'show_tags',         'display_name' => 'Tags',               'route' => 'tags.index',        'module' => 'tags', 'as' => 'tags.index',       'icon' => 'fas fa-tags',         'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createTags   = Permission::create([ 'name' => 'create_tags',       'display_name' => 'Create Tags',        'route' => 'tags.create',       'module' => 'tags', 'as' => 'tags.create',      'icon' => null,                  'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateTags   = Permission::create([ 'name' => 'update_tags',       'display_name' => 'Update Tags',        'route' => 'tags.edit',         'module' => 'tags', 'as' => 'tags.edit',        'icon' => null,                  'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyTags  = Permission::create([ 'name' => 'delete_tags',       'display_name' => 'Delete Tags',        'route' => 'tags.destroy',      'module' => 'tags', 'as' => 'tags.destroy',     'icon' => null,                  'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id,'sidebar_link' => '1', 'appear' => '0', ]);

        //Products
        $manageProducts = Permission::create([ 'name' => 'manage_products', 'display_name' => 'Products', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-tshirt', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '15', ]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();
        $showProducts    = Permission::create([ 'name' => 'show_products',          'display_name' => 'Products',             'route' => 'products.index',          'module' => 'products', 'as' => 'products.index',       'icon' => 'fas fa-tshirt',       'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createProducts  = Permission::create([ 'name' => 'create_products',        'display_name' => 'Create Products',      'route' => 'products.create',         'module' => 'products', 'as' => 'products.create',      'icon' => null,                  'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateProducts  = Permission::create([ 'name' => 'update_products',        'display_name' => 'Update Products',      'route' => 'products.edit',           'module' => 'products', 'as' => 'products.edit',        'icon' => null,                  'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyProducts = Permission::create([ 'name' => 'delete_products',        'display_name' => 'Delete Products',      'route' => 'products.destroy',        'module' => 'products', 'as' => 'products.destroy',     'icon' => null,                  'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);





























    }
}