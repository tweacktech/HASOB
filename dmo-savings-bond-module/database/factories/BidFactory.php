<?php

namespace Database\Factories;

use DMO\SavingsBond\Models\Bid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class BidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bid::class;

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
        'offer_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'status' => $this->faker->word,
        'wf_status' => $this->faker->word,
        'wf_meta_data' => $this->faker->text,
        'units_requested' => $this->faker->randomDigitNotNull,
        'price_per_unit' => $this->faker->word,
        'total_price' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
