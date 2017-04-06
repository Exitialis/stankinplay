<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (app()->environment() != 'testing') {
            DB::unprepared('
            CREATE TRIGGER `check_discipline_max_players` after INSERT ON `role_user`
            FOR EACH ROW BEGIN
               declare maxPlayers int(10);
               declare currentPlayers int(10);
               declare disciplineName VARCHAR(100);
               select disciplines.name, disciplines.max_players INTO disciplineName, maxPlayers from disciplines
                    join user_discipline on disciplines.id = user_discipline.discipline_id
                    join users on users.id = user_discipline.user_id
                    where users.id = NEW.user_id;
               select countPlayersInDiscipline(disciplineName) into currentPlayers;
               IF currentPlayers >= maxPlayers THEN
                    SIGNAL SQLSTATE \'45000\'
                    SET MESSAGE_TEXT = \'Player limit exceeded\';
                END IF;
            END;
        ');
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (app()->environment() != 'testing') {
            \DB::unprepared('drop trigger check_discipline_max_players');
        }
    }
}
