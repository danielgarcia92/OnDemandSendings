<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailsFactory extends Factory
{
    /**  @return array */
    public function definition()
    {
        return [
            'email'   => 'daniel.garciav@vivaaerobus.com',
            'apps_id' => 1,
            'active'  => 1
        ];
    }
}
