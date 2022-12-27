<?php

namespace Database\Factories;

use DMO\SavingsBond\Models\Offer;
/*use DMO\SavingsBond\Database\Seeders\OffersTableSeeder;*/
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

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
            'offer_title' => $this->faker->word,
            'price_per_unit' => $this->faker->randomDigitNotNull,
            'max_units_per_investor' => $this->faker->randomDigitNotNull,
            'interest_rate_pct' => $this->faker->randomDigitNotNull,
            'offer_start_date' => $this->faker->date('Y-m-d H:i:s'),
            'offer_end_date' => $this->faker->date('Y-m-d H:i:s'),
            'offer_settlement_date' => $this->faker->date('Y-m-d H:i:s'),
            'offer_maturity_date' => $this->faker->date('Y-m-d H:i:s'),
            'tenor_years' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
