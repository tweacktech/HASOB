<?php

namespace Database\Factories;

use DMO\SavingsBond\Models\BrokerStaff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class BrokerStaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BrokerStaff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => $this->faker->word,
        'display_ordinal' => $this->faker->randomDigitNotNull,
        'broker_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'status' => $this->faker->word,
        'role' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
