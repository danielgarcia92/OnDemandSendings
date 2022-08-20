<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**  @var string */
    protected $model = User::class;

    /**  @return array */
    public function definition()
    {
        return [
            'name' => 'Daniel García',
            'rol' => 'admin',
            'email' => 'daniel.garciav@vivaaerobus.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$iz9KPL69LiQcoZGxD6RqvO8WX6lBhuy1ymRUAE4wGaXh8.c0r.WYi',
            'remember_token' => Str::random(10),
        ];
    }

    /** @return \Illuminate\Database\Eloquent\Factories\Factory */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /** @return $this */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
