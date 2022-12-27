<?php

namespace Database\Factories;

use DMO\SavingsBond\Models\Investor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;

class InvestorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investor::class;

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
        'is_broker_created' => $this->faker->word,
        'user_id' => $this->faker->word,
        'date_of_birth' => $this->faker->date('Y-m-d H:i:s'),
        'origin_geo_zone' => $this->faker->word,
        'origin_lga' => $this->faker->word,
        'address_street' => $this->faker->word,
        'address_town' => $this->faker->word,
        'address_state' => $this->faker->word,
        'status' => $this->faker->word,
        'wf_status' => $this->faker->word,
        'wf_meta_data' => $this->faker->text,
        'bank_account_name' => $this->faker->word,
        'bank_account_number' => $this->faker->word,
        'bank_name' => $this->faker->word,
        'is_bank_account_verified' => $this->faker->word,
        'bank_account_meta_data' => $this->faker->text,
        'bank_verification_number' => $this->faker->word,
        'is_bvn_verified' => $this->faker->word,
        'bvn_meta_data' => $this->faker->text,
        'national_id_number' => $this->faker->word,
        'is_nin_verified' => $this->faker->word,
        'nin_meta_data' => $this->faker->text,
        'cscs_id_number' => $this->faker->word,
        'is_cscs_id_verified' => $this->faker->word,
        'cscs_meta_data' => $this->faker->text,
        'chn_id_number' => $this->faker->word,
        'is_chn_id_verified' => $this->faker->word,
        'chn_meta_data' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
