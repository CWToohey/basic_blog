<?php

namespace App\Console\Commands;

use App\role_user;
use Illuminate\Console\Command;
use App\User;
use App\Role;
use App\Permission;

class testdb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get();
        echo "\nusers\n";

        foreach ($users as $user)
        {
            echo $user->name." ".$user->email." ".$user->password."\n";
        }
//        var_dump($users);
        echo "\nroles\n";
        $roles = Role::get();
        foreach ($roles as $role)
        {
            echo $role->name." ".$role->display_name."\n";
        }

        echo "\nrole user\n";
        $role_users = role_user::get();
        foreach ($role_users as $role)
        {
            echo $role->role_id." ".$role->user_id."\n";
        }

        echo "\nPermission\n";
        $Permission = Permission::get();
        foreach ($Permission as $role)
        {
            echo $role->name." ".$role->display_name."\n";
        }

    }
}
