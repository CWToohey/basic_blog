<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = new PermissionsTableSeeder();
        $permissions->run();
        $roles = new RolesTableSeeder();
        $roles->run();
        $headings = new headingsSeeder();
        $headings->run();
        $posts = new postsSeeder();
        $posts->run();

        $user = [
            [
                'name' => 'Joe',
                'email' => 'jo@jo.com',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

        $role = [
            [
                'user_id' => 1,
                'role_id' => 1,
            ],
        ];

        foreach ($role as $key => $value) {
            DB::table('role_user')->insert($value);
        }


    }
}
