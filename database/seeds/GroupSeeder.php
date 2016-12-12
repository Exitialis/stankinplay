<?php

use Illuminate\Database\Seeder;
use PHPHtmlParser\Dom;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dom = new Dom();

        $dom->loadFromFile(storage_path('stankinru.html'));

        $el = $dom->find('.text')[0];

        $links = $el->getChildren();

        $specialists = [
            16 => 2,
            15 => 2,
            14 => 2,
            12 => 1,
            11 => 1
        ];

        foreach ($links as $link) {
            if ($link instanceof Dom\HtmlNode) {
                if ($link->tag->name() == 'a') {
                    $name = $link->text;

                    if ($name === '' || $name === ' ' || $name === '&nbsp;' || $name === '  ') {
                        continue;
                    }
                    if ( ! \App\Models\Group::where('name', 'LIKE', '%'.$name.'%')->first()) {
                        $group = new \App\Models\Group();
                        $group->name = $name;
                        $group->save();
                    }
                }
            }
        }

        foreach ($specialists as $key => $value) {
            for($i = 0; $i < $value; $i++) {
                \App\Models\Group::create(['name' => 'МДС-'.$key.'-0'.$value]);
            }
        }
    }
}
