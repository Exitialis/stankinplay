<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ParseCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $users = User::select('first_name', 'last_name', 'middle_name', 'group', 'module', 'team_id')->whereHas('team', function($query) {
            $query->where('name', '#lowiq')->orWhere('name', 'MAT.Team')->orWhere('name', 'MayDay');
        })->with(['team' => function($query) {
            $query->select('id', 'name');
        }])->where('discipline_id', 1)->get();

        $file = fopen(public_path('test.csv'), 'r+');

        $content = [
            'Фамилия',
            'Имя',
            'Отчество',
            'Группа',
            'Команда',
            'Модуль'
        ];

        fputcsv($file, $content);
        foreach ($users as $user) {
            $content = [
                $user->last_name,
                $user->first_name,
                $user->middle_name,
                $user->group,
                $user->team->name,
                $user->module ? 'Нужен' : 'Не нужен'
            ];
            fputcsv($file, $content);
        }


        fclose($file);
    }
}
