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

        foreach ($links as $link) {
            if ($link instanceof Dom\HtmlNode) {
                if ($link->tag->name() == 'a') {
                    $name = $link->text;

                    if ($name === '' || $name === ' ' || $name === '&nbsp;' || $name === '  ') {
                        continue;
                    }
                    if ( ! \App\Models\Group::where('name', 'LIKE', '%'.$name.'%')->first()) {
                        \App\Models\Group::create($name);
                    }
                }
            }
        }
    }
}
