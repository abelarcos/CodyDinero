<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Movement;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Movement::truncate();

        $user = new User;
        $user->name = "abel";
        $user->email = "abel302010@hotmail.com";
        $user->password = bcrypt('abel123');
        $user->save();

        for ($i= 0; $i < 50; $i++){//iteracion para que cada usuario tenga asociado un movimiento

            $user->movements()->save(factory(Movement::class)->make());
        }

        factory(User::class, 10)->create()->each( function ($u) {

            for ($i= 0; $i < 30; $i++){//iteracion para que cada usuario tenga asociado un movimiento

                $u->movements()->save(factory(Movement::class)->make());
            }
        });
    }
}
