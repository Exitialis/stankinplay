<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createTeam = Permission::where('name', 'create-team')->first();
        $editTeam = Permission::where('name', 'edit-team')->first();

        if ( ! Role::where('name', 'admin')->first()) {
            $admin = new Role();

            $admin->name = 'admin';
            $admin->display_name = 'Администратор';
            $admin->description = 'Администратор сайта';
            $admin->save();

            $admin->attachPermissions([$createTeam, $editTeam]);
        }

        if ( ! Role::where('name', 'captain')->first()) {
            $captain = new Role();

            $captain->name = 'captain';
            $captain->display_name = 'Капитан';
            $captain->description = 'Капитан команды';
            $captain->save();

            $captain->attachPermissions([$createTeam, $editTeam]);
        }

        if ( ! Role::where('name', 'moderator')->first()) {
            $moderator = new Role();

            $moderator->name = 'moderator';
            $moderator->display_name = 'Модератор';
            $moderator->description = 'Модератор сайта';
            $moderator->save();
        }

        if ( ! Role::where('name', 'player')->first()) {
            $player = new Role();

            $player->name = 'player';
            $player->display_name = 'Игрок';
            $player->description = 'Игрок';
            $player->save();
        }

        if ( ! Role::where('name', 'member')->first()) {
            $member = new Role();

            $member->name = 'member';
            $member->display_name = 'Участник';
            $member->description = 'Участник секции';
            $member->save();
        }
    }
}
