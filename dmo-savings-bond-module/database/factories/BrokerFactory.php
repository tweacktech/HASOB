<?php

namespace Database\Factories;

use DMO\SavingsBond\Models\Broker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class BrokerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Broker::class;

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
        'status' => $this->faker->word,
        'wf_status' => $this->faker->word,
        'wf_meta_data' => $this->faker->text,
        'broker_code' => $this->faker->word,
        'full_name' => $this->faker->word,
        'short_name' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
