<?php

use App\Cosplay;
use App\CosplayPart;
use App\Gasto;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CosplaySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCosplays(50);
        $this->createCosplayParts();
        $this->createCosplayCosts();
        $this->createCosplayTasks();

    }

    private function createCosplays($cant)
    {
        $faker = Faker::create();

        for ($i = 1; $i <= $cant; $i++) {
            
            
            $users = User::all()->pluck('id')->toArray();
            
            $randUsers = $faker->randomElements($users,rand(1,3));
            $owner = $faker->randomElement($users);
            $cosplay = Cosplay::create([
                'name' => $faker->name(),
                'status' => $faker->randomElement([Cosplay::PLANNED, Cosplay::IN_PROGRESS, Cosplay::FINISHED]),
                'description' => $faker->realText(),
                'budget' => $faker->randomFloat(2,10,1500),
                'owner' =>$owner 
            ]);

            $pivotData = [
                'cosplay_id' => $cosplay->id,
                'user_id' => $owner
            ];
            
            for ($j = 1; $j <= rand(1,3); $j++) {
                $pivotData [] = [
                    'cosplay_id' => $cosplay->id,
                    'user_id' => $faker->randomElement($users)
                ];
            }

            $cosplay->users()->sync($pivotData);

            

        }
    }

    private function createCosplayParts()
    {
        $faker = Faker::create();
        $cosplays = Cosplay::all();

        foreach ($cosplays as $cosplay) {
            $cant = rand(1, 10);
            for ($i = 1; $i <= $cant; $i++) {
                CosplayPart::create([
                    'cosplay_id' => $cosplay->id,
                    'name' => $faker->name(),
                    'progress' => $faker->numberBetween(0, 100),
                    'description' => $faker->realText(),
                    'status' => $faker->randomElement([CosplayPart::STATUS_PLANNED, CosplayPart::STATUS_IN_PROGRESS, CosplayPart::STATUS_FINISHED]),
                ]);
            }

        }
    }
    
    private function createCosplayCosts()
    {
        $faker = Faker::create();
        $cosplays = Cosplay::all();

        foreach ($cosplays as $cosplay) {
            $cant = rand(1, 10);
            for ($i = 1; $i <= $cant; $i++) {
                Gasto::create([
                    'cosplay_id' => $cosplay->id,
                    'name' => $faker->name(),
                    'cost' => $faker->randomFloat(2,0.01,1500)
                ]);
            }
        }
    }


    private function createCosplayTasks()
    {
        $faker = Faker::create();
        $cosplays = Cosplay::all();

        foreach ($cosplays as $cosplay) {
            $cant = rand(1, 10);
            for ($i = 1; $i <= $cant; $i++) {
                Task::create([
                    'cosplay_id' => $cosplay->id,
                    'name' => $faker->name(),
                    'status' => $faker->randomElement([ Task::STATUS_COMPLETED, Task::STATUS_INCOMPLETED]),
                ]);
            }
        }
    }
}
