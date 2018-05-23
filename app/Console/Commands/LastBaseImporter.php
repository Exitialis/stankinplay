<?php

namespace App\Console\Commands;

use App\Models\Discipline;
use App\Models\Group;
use App\Models\Team;
use App\Models\UniversityProfile;
use App\Models\User;
use Illuminate\Console\Command;

class LastBaseImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:seed');

        $groupsOld = \DB::connection('prev')
            ->table('groups')
            ->get();

        foreach ($groupsOld as $groupOld) {
            Group::create([
                'name' => $groupOld->name
            ]);
        }

        $disciplinesOld = \DB::connection('prev')
            ->table('disciplines')
            ->get();

        foreach ($disciplinesOld as $disciplineOld) {
            $discipline = new Discipline();
            $discipline->name = $disciplineOld->name;
            $discipline->label = $disciplineOld->label;
            $discipline->max_players = 10;
            $discipline->save();
        }

        $users = \DB::connection('prev')
            ->table('users')
            ->join('university_profiles', 'users.id', '=', 'university_profiles.user_id')
            ->select('users.*', 'university_profiles.*')
            ->get();

        //dd($users->first());

        foreach ($users as $userOld) {
            $user = new User();
            $user->id = $userOld->user_id;
            $user->login = $userOld->login;
            $user->first_name = $userOld->first_name;
            $user->last_name = $userOld->last_name;
            $user->middle_name = $userOld->middle_name;
            $user->email = $userOld->email;
            $user->password = $userOld->password;
            $user->save();

            $profile = new UniversityProfile();
            $profile->user_id = $userOld->user_id;
            $profile->group_id = $userOld->group_id;
            $profile->studentID = $userOld->studentID;
            $profile->module = $userOld->module;
            $profile->budget = $userOld->budget;
            $profile->grants = $userOld->grants;
            $profile->anotherSections = $userOld->anotherSections;
            $profile->gto = $userOld->gto;
            $profile->socialActivity = $userOld->socialActivity;
            $profile->save();
        }

        $teamsOld = \DB::connection('prev')
            ->table('teams')
            ->get();

        foreach ($teamsOld as $teamOld) {
            $team = new Team();
            $team->id = $teamOld->id;
            $team->captain_id = $teamOld->captain_id;
            $team->discipline_id = $teamOld->discipline_id;
            $team->name = $teamOld->name;
            $team->save();
        }


        foreach ($users as $userOld) {
            if (!$userOld->team_id) {
                continue;
            }
            \DB::table('user_team')->insert([
                'user_id' => $userOld->user_id,
                'team_id' => $userOld->team_id
            ]);
            \DB::table('user_discipline')->insert([
                'user_id' => $userOld->user_id,
                'discipline_id' => $userOld->discipline_id
            ]);
        }

        $roles = \DB::connection('prev')
            ->table('role_user')
            ->get();

        foreach ($roles as $old) {
            \DB::table('role_user')
                ->insert([
                    'user_id' => $old->user_id,
                    'role_id' => $old->role_id
                ]);
        }
    }
}
