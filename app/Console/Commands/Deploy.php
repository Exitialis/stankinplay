<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\UniversityProfile;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;
use Masterminds\HTML5;
use PHPHtmlParser\Dom;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy application changes for database';

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
        \DB::transaction(function() {
            //Создаем новые таблицы
            $this->call('migrate');



            $users = User::get();

            //Переносим данные из полей пользователя в профиль.
            foreach ($users as $user) {
                $profile = new UniversityProfile();

                foreach ($profile->getAttributes() as $attribute) {
                    if ($attribute == 'group') {
                        $profile->group_id = Group::where('name', 'LIKE', '%'.$user->group.'%')->first()->id;
                    }

                    $profile->{$attribute} = $user->{$attribute};
                }

                $profile->save();
            }

            $this->dropUserFields();
        });
    }

    /**
     * Удалить ненужные поля, которые были перенесены в профиль пользователя.
     */
    private function dropUserFields()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'middle_name', 'group', 'module']);
        });
    }
}
