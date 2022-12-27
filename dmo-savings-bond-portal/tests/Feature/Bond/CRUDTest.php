<?php

namespace Tests\Feature\Bond;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Hasob\FoundationCore\Models\Organization;
use DMO\SavingsBond\Models\Offer;
use Database\Factories\OfferFactory;
use Carbon\Carbon;
use Tests\TestCase;

class CRUDTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Create()
    {

$org_id = Organization::create([  'org' => 'apptest', 'domain' => 'app-test-domain', 'full_url' => 'www.app-test-domain.test', 'subdomain' => 'app.app-test-domain.test', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

      $Data = Offer::create([ 
        'organization_id' => "$org_id",'status'=>'true','offer_title'=>'BOss',
        'price_per_unit'=>'20110230','max_units_per_investor'=>'4993',
        'interest_rate_pct'=>'3304','offer_start_date'=>'',
        'offer_end_date'=>'dv','offer_settlement_date'=>'',
        'offer_maturity_date'=>'','tenor_years'=>'' ]);
 $this->assertDatabaseHas('sb_offers', ['offer_title' => "$Data->offer_title",]);
    }

    public function test_Retrieve(){
      $org_id = Organization::create([  'org' => 'apptest', 'domain' => 'app-test-domain', 'full_url' => 'www.app-test-domain.test', 'subdomain' => 'app.app-test-domain.test', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

      $Data = Offer::create([ 
        'organization_id' => "$org_id",'status'=>'true','offer_title'=>'BOss',
        'price_per_unit'=>'20110230','max_units_per_investor'=>'4993',
        'interest_rate_pct'=>'3304','offer_start_date'=>'',
        'offer_end_date'=>'dv','offer_settlement_date'=>'',
        'offer_maturity_date'=>'','tenor_years'=>'' ]);

      $findOffer=Offer::find($Data->id);
      $this->assertNotEmpty($findOffer);
$this->assertEquals($Data->offer_title, $findOffer->offer_title);


    }


public function test_Update(){
      $org_id = Organization::create([  'org' => 'apptest', 'domain' => 'app-test-domain', 'full_url' => 'www.app-test-domain.test', 'subdomain' => 'app.app-test-domain.test', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

      $Data = Offer::create([ 
        'organization_id' => "$org_id",'status'=>'true','offer_title'=>'BOss',
        'price_per_unit'=>'20110230','max_units_per_investor'=>'4993',
        'interest_rate_pct'=>'3304','offer_start_date'=>'',
        'offer_end_date'=>'dv','offer_settlement_date'=>'',
        'offer_maturity_date'=>'','tenor_years'=>'' ]); 
      $findOffer=Offer::find($Data->id);
      $this->assertNotEmpty( $findOffer);
      $DataUpdate=$findOffer->update(['status'=>'true','offer_title'=>'New title',
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);   
       $this->assertNotEquals($Data['status'],$DataUpdate['status']);
    }

public function test_Delete(){
      $org_id = Organization::create([  'org' => 'apptest', 'domain' => 'app-test-domain', 'full_url' => 'www.app-test-domain.test', 'subdomain' => 'app.app-test-domain.test', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

      $Data = Offer::create([ 
        'organization_id' => "$org_id",'status'=>'true','offer_title'=>'BOss',
        'price_per_unit'=>'20110230','max_units_per_investor'=>'4993',
        'interest_rate_pct'=>'3304','offer_start_date'=>'',
        'offer_end_date'=>'dv','offer_settlement_date'=>'',
        'offer_maturity_date'=>'','tenor_years'=>'' ]); 
        $this->assertInstanceOf(Offer::class, $Data);
      $findOffer=Offer::find($Data->id);
      $findOffer->delete($Data->id);   
      $checkOffer=Offer::find($Data->id);
      $this->assertEmpty($checkOffer);
    }
}
