<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctions extends Migration
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
            CREATE FUNCTION countPlayersInDiscipline(disciplineName VARCHAR(100)) RETURNS INT
            READS SQL DATA
            DETERMINISTIC
            BEGIN  
                DECLARE role_id int(10);
				DECLARE counter int(10);
                select id INTO role_id from roles where `name` = \'member\';
                select count(*) into counter from users
                    join user_discipline on users.id = user_discipline.user_id
                    join disciplines on disciplines.id = user_discipline.discipline_id
                    join role_user on users.id = role_user.user_id
                    join roles on role_user.role_id = roles.id
                    where disciplines.name = disciplineName AND roles.name = \'member\';
                return counter;
            END
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
            \DB::unprepared('drop function countPlayersInDiscipline');
        }
    }
}
