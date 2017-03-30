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
                select id INTO role_id from roles where `name` = \'member\' COLLATE utf8_unicode_ci;
                select count(*) INTO counter from users
                    join user_discipline on users.id = user_discipline.user_id
                    join disciplines on disciplines.id = user_discipline.discipline_id
                    where disciplines.name = disciplineName COLLATE utf8_unicode_ci;
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
