<?php

use App\AbsenceMessage;
use App\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $groups = [];
        $groups[] = factory(\App\Group::class)->create(['name' => '5313obk7eiB']);
        $groups[] = factory(\App\Group::class)->create(['name' => '5314obk2fiF']);
        $groups[] = factory(\App\Group::class)->create(['name' => '5314obk4fdF']);
        $groups[] = factory(\App\Group::class)->create(['name' => 'opbwu15fint']);
        $teacher = factory(\App\User::class, 1)->create([
            'username' => 'mdam',
            'teacher' => 1
        ]);

        foreach ($groups as $group) {
            $users = collect(factory(\App\User::class, 10)->create());
            $group->users()->attach($users->pluck('id'));
            $group->users()->attach($teacher);

            $subjects = collect();
            $subjects->push(factory(\App\Subject::class)->create([
                'group_id' => $group->id,
                'name' => 'Modern frontend'
            ]));
            $subjects->push(factory(\App\Subject::class)->create([
                'group_id' => $group->id,
                'name' => 'Mobile development'
            ]));
            $date = Carbon::now()->startOfWeek();

            for ($week = 1; $week < 7; $week++) {
                $date->addWeek()->startOfWeek();

                foreach ($subjects as $subject) {
                    $date->addDay();
                    $start = $date->copy()->hour(8)->minute(0);
                    $end = $start->copy()->hour(2);

                    factory(\App\Lesson::class)->create([
                        'subject_id' => $subject->id,
                        'started_at' => $start,
                        'ended_at' => $end
                    ]);

                    $this->addAttendance($start, $end, $users);
                }
            }
        }
    }

    private function addAttendance(Carbon $start, Carbon $end, $users) {
        foreach ($users as $user) {
            if (rand(1, 50) === 50) {
                AbsenceMessage::create([
                    'message' => 'sick',
                    'started_at' => $start,
                    'ended_at' => $end,
                    'user_id' => $user->id
                ]);

                continue;
            }

            $manual = rand(1, 10) === 10;
            Attendance::create([
                'latitude' => $manual ? 55.394292 : null,
                'longitude' => $manual ? 10.3821023 : null,
                'started_at' => $start,
                'ended_at' => $end,
                'accepted' => false,
                'user_id' => $user->id
            ]);
        }
    }
}
