<?php

namespace Database\Seeders;

use App\Models\ElementTemplate;
use Illuminate\Database\Seeder;

class LaravelBlock2ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelBlock2Content")->first();

        if (!$template) {
            $template = ElementTemplate::create(
                [
                    "title" => "Laravel Block2 Content",
                    "component" => "LaravelBlock2Content",
                ]
            );
        }
    }
}
