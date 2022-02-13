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



        //Admins
        $manageAdmins = Permission::create([ 'name' => 'manage_admins', 'display_name' => 'Admins', 'route' => 'admins', 'module' => 'admins', 'as' => 'admins.index', 'icon' => 'fas fa-user-shield', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '0', 'appear' => '1', 'ordering' => '200', ]);
        $manageAdmins->parent_show = $manageAdmins->id;
        $manageAdmins->save();
        $showAdmins    = Permission::create([ 'name' => 'show_admins',          'display_name' => 'Admins',              'route' => 'admins.index',          'module' => 'admins', 'as' => 'admins.index',       'icon' => 'fas fa-user-shield',  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '0', 'appear' => '1', ]);
        $createAdmins  = Permission::create([ 'name' => 'create_admins',        'display_name' => 'Create Admins',       'route' => 'admins.create',         'module' => 'admins', 'as' => 'admins.create',      'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '0', 'appear' => '0', ]);
        $updateAdmins  = Permission::create([ 'name' => 'update_admins',        'display_name' => 'Update Admins',       'route' => 'admins.edit',           'module' => 'admins', 'as' => 'admins.edit',        'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '0', 'appear' => '0', ]);
        $destroyAdmins = Permission::create([ 'name' => 'delete_admins',        'display_name' => 'Delete Admins',       'route' => 'admins.destroy',        'module' => 'admins', 'as' => 'admins.destroy',     'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '0', 'appear' => '0', ]);

        //Users
        $manageUsers = Permission::create([ 'name' => 'manage_users', 'display_name' => 'Users', 'route' => 'admins', 'module' => 'users', 'as' => 'users.index', 'icon' => 'fas fa-users', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '0', 'appear' => '1', 'ordering' => '210', ]);
        $manageUsers->parent_show = $manageUsers->id;
        $manageUsers->save();
        $showUsers    = Permission::create([ 'name' => 'show_users',          'display_name' => 'Users',              'route' => 'users.index',          'module' => 'users', 'as' => 'users.index',       'icon' => 'fas fa-users',        'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '0', 'appear' => '1', ]);
        $createUsers  = Permission::create([ 'name' => 'create_users',        'display_name' => 'Create Users',       'route' => 'users.create',         'module' => 'users', 'as' => 'users.create',      'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '0', 'appear' => '0', ]);
        $updateUsers  = Permission::create([ 'name' => 'update_users',        'display_name' => 'Update Users',       'route' => 'users.edit',           'module' => 'users', 'as' => 'users.edit',        'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '0', 'appear' => '0', ]);
        $destroyUsers = Permission::create([ 'name' => 'delete_users',        'display_name' => 'Delete Users',       'route' => 'users.destroy',        'module' => 'users', 'as' => 'users.destroy',     'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '0', 'appear' => '0', ]);


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
        ## Product Coupons ##
        $showProductCoupons    = Permission::create([ 'name' => 'show_productCoupons',          'display_name' => 'Product Coupons',              'route' => 'productCoupons.index',          'module' => 'products', 'as' => 'productCoupons.index',       'icon' => 'fas fa-money-bill-wave', 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createProductCoupons  = Permission::create([ 'name' => 'create_productCoupons',        'display_name' => 'Create Product Coupons',       'route' => 'productCoupons.create',         'module' => 'products', 'as' => 'productCoupons.create',      'icon' => null,                     'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateProductCoupons  = Permission::create([ 'name' => 'update_productCoupons',        'display_name' => 'Update Product Coupons',       'route' => 'productCoupons.edit',           'module' => 'products', 'as' => 'productCoupons.edit',        'icon' => null,                     'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyProductCoupons = Permission::create([ 'name' => 'delete_productCoupons',        'display_name' => 'Delete Product Coupons',       'route' => 'productCoupons.destroy',        'module' => 'products', 'as' => 'productCoupons.destroy',     'icon' => null,                     'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        ## Product Reviews ##
        $showProductReviews    = Permission::create([ 'name' => 'show_productReviews',          'display_name' => 'Product Reviews',              'route' => 'productReviews.index',          'module' => 'products', 'as' => 'productReviews.index',       'icon' => 'fas fa-comments',     'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createProductReviews  = Permission::create([ 'name' => 'create_productReviews',        'display_name' => 'Create Product Reviews',       'route' => 'productReviews.create',         'module' => 'products', 'as' => 'productReviews.create',      'icon' => null,                  'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateProductReviews  = Permission::create([ 'name' => 'update_productReviews',        'display_name' => 'Update Product Reviews',       'route' => 'productReviews.edit',           'module' => 'products', 'as' => 'productReviews.edit',        'icon' => null,                  'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyProductReviews = Permission::create([ 'name' => 'delete_productReviews',        'display_name' => 'Delete Product Reviews',       'route' => 'productReviews.destroy',        'module' => 'products', 'as' => 'productReviews.destroy',     'icon' => null,                  'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id,'sidebar_link' => '1', 'appear' => '0', ]);


        //Customers
        $manageCustomers = Permission::create([ 'name' => 'manage_customers', 'display_name' => 'Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '25', ]);
        $manageCustomers->parent_show = $manageCustomers->id;
        $manageCustomers->save();
        $showCustomers    = Permission::create([ 'name' => 'show_customers',          'display_name' => 'Customers',              'route' => 'customers.index',          'module' => 'customers', 'as' => 'customers.index',       'icon' => 'fas fa-user',         'parent' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'parent_original' => $manageCustomers->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createCustomers  = Permission::create([ 'name' => 'create_customers',        'display_name' => 'Create Customers',       'route' => 'customers.create',         'module' => 'customers', 'as' => 'customers.create',      'icon' => null,                  'parent' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'parent_original' => $manageCustomers->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateCustomers  = Permission::create([ 'name' => 'update_customers',        'display_name' => 'Update Customers',       'route' => 'customers.edit',           'module' => 'customers', 'as' => 'customers.edit',        'icon' => null,                  'parent' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'parent_original' => $manageCustomers->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyCustomers = Permission::create([ 'name' => 'delete_customers',        'display_name' => 'Delete Customers',       'route' => 'customers.destroy',        'module' => 'customers', 'as' => 'customers.destroy',     'icon' => null,                  'parent' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'parent_original' => $manageCustomers->id,'sidebar_link' => '1', 'appear' => '0', ]);


        //Countries
        $manageCountries = Permission::create([ 'name' => 'manage_countries', 'display_name' => 'Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '100', ]);
        $manageCountries->parent_show = $manageCountries->id;
        $manageCountries->save();
        $showCountries    = Permission::create([ 'name' => 'show_countries',          'display_name' => 'Countries',              'route' => 'countries.index',          'module' => 'countries', 'as' => 'countries.index',       'icon' => 'fas fa-globe',        'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createCountries  = Permission::create([ 'name' => 'create_countries',        'display_name' => 'Create Countries',       'route' => 'countries.create',         'module' => 'countries', 'as' => 'countries.create',      'icon' => null,                  'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateCountries  = Permission::create([ 'name' => 'update_countries',        'display_name' => 'Update Countries',       'route' => 'countries.edit',           'module' => 'countries', 'as' => 'countries.edit',        'icon' => null,                  'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyCountries = Permission::create([ 'name' => 'delete_countries',        'display_name' => 'Delete Countries',       'route' => 'countries.destroy',        'module' => 'countries', 'as' => 'countries.destroy',     'icon' => null,                  'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        //States
        $showStates    = Permission::create([ 'name' => 'show_states',          'display_name' => 'States',              'route' => 'states.index',          'module' => 'countries', 'as' => 'states.index',       'icon' => 'fas fa-map-marker-alt', 'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createStates  = Permission::create([ 'name' => 'create_states',        'display_name' => 'Create States',       'route' => 'states.create',         'module' => 'countries', 'as' => 'states.create',      'icon' => null,                    'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateStates  = Permission::create([ 'name' => 'update_states',        'display_name' => 'Update States',       'route' => 'states.edit',           'module' => 'countries', 'as' => 'states.edit',        'icon' => null,                    'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyStates = Permission::create([ 'name' => 'delete_states',        'display_name' => 'Delete States',       'route' => 'states.destroy',        'module' => 'countries', 'as' => 'states.destroy',     'icon' => null,                    'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        //Cities
        $showCities    = Permission::create([ 'name' => 'show_cities',          'display_name' => 'Cities',              'route' => 'cities.index',          'module' => 'countries', 'as' => 'cities.index',       'icon' => 'fas fa-university',   'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createCities  = Permission::create([ 'name' => 'create_cities',        'display_name' => 'Create Cities',       'route' => 'cities.create',         'module' => 'countries', 'as' => 'cities.create',      'icon' => null,                  'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateCities  = Permission::create([ 'name' => 'update_cities',        'display_name' => 'Update Cities',       'route' => 'cities.edit',           'module' => 'countries', 'as' => 'cities.edit',        'icon' => null,                  'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyCities = Permission::create([ 'name' => 'delete_cities',        'display_name' => 'Delete Cities',       'route' => 'cities.destroy',        'module' => 'countries', 'as' => 'cities.destroy',     'icon' => null,                  'parent' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'parent_original' => $manageCountries->id,'sidebar_link' => '1', 'appear' => '0', ]);


        //Contact
        $manageContacts = Permission::create([ 'name' => 'manage_contacts', 'display_name' => 'Contacts', 'route' => 'Contacts', 'module' => 'Contacts', 'as' => 'Contacts', 'icon' => 'fas fa-mobile-alt', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '115', ]);
        $manageContacts->parent_show = $manageContacts->id;
        $manageContacts->save();
            ##Social Media
            $showSocials    = Permission::create([ 'name' => 'show_social', 'display_name' => 'Social Media',   'route' => 'socials.index',     'module' => 'Contacts',     'as' => 'socials.index',    'icon' => 'fas fa-thumbs-up',           'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Phone Number
            $showPhones     = Permission::create([ 'name' => 'show_phone',  'display_name' => 'Phones',         'route' => 'phones.index',      'module' => 'Contacts',     'as' => 'phones.index',     'icon' => 'fas fa-phone-square-alt',    'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##E_Mail
            $showEmails     = Permission::create([ 'name' => 'show_email',  'display_name' => 'E-Mails',        'route' => 'emails.index',      'module' => 'Contacts',     'as' => 'emails.index',     'icon' => 'fas fa-envelope-open-text',  'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);

















    }
}
