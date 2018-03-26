<?php

use Illuminate\Database\Seeder;
use App\headings;

class headingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'key' => 'PageHeading',
                'label'=>'Page Title',
                'content' => "Candidate Blog",
            ],
            [
                'key' => 'PageSubHead',
                'label'=>'Page Subtitle',
                'content' => "Running for Office",
            ]
        ];

        foreach ($values as $key => $value) {
            headings::create($value);
        }
    }
}
