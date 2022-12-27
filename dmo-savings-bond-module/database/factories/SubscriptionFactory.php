<?php

namespace Database\Factories;

use DMO\SavingsBond\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

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
        'broker_id' => $this->faker->word,
        'broker_code' => $this->faker->word,
        'broker_name' => $this->faker->word,
        'is_broker_created' => $this->faker->word,
        'status' => $this->faker->word,
        'wf_status' => $this->faker->word,
        'wf_meta_data' => $this->faker->text,
        'units_requested' => $this->faker->randomDigitNotNull,
        'price_per_unit' => $this->faker->word,
        'total_price' => $this->faker->word,
        'interest_rate_pct' => $this->faker->word,
        'offer_start_date' => $this->faker->date('Y-m-d H:i:s'),
        'offer_end_date' => $this->faker->date('Y-m-d H:i:s'),
        'offer_settlement_date' => $this->faker->date('Y-m-d H:i:s'),
        'offer_maturity_date' => $this->faker->date('Y-m-d H:i:s'),
        'tenor_years' => $this->faker->randomDigitNotNull,
        'investor_email' => $this->faker->word,
        'investor_telephone' => $this->faker->word,
        'first_name' => $this->faker->word,
        'middle_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'date_of_birth' => $this->faker->date('Y-m-d H:i:s'),
        'origin_geo_zone' => $this->faker->word,
        'origin_lga' => $this->faker->word,
        'address_street' => $this->faker->word,
        'address_town' => $this->faker->word,
        'address_state' => $this->faker->word,
        'bank_account_name' => $this->faker->word,
        'bank_account_number' => $this->faker->word,
        'bank_name' => $this->faker->word,
        'bank_verification_number' => $this->faker->word,
        'national_id_number' => $this->faker->word,
        'cscs_id_number' => $this->faker->word,
        'chn_id_number' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
