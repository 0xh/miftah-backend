<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * @author Ibrahim Samad <naatogma@gmail.com>
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'email' => 'naatogma@gmail.com',
        ], [
            'name' => 'Ibrahim Samad',
            'username' => 'ultrasamad',
            'email_verified_at' => now(),
            'password' => bcrypt(config('miftah.admin_password')),
            'avatar' => 'https://s.gravatar.com/avatar/c39ca80df6397b97fbd93a3c479a742a?s=80',
        ]);

        //Assign both api and web guards
        $roles = Role::where('name', 'Super Admin')->get();
        $user->assignRole($roles);
    }
}
