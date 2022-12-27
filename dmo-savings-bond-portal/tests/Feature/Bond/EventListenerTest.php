<?php

namespace Tests\Feature\Bond;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Listeners\OfferCreatedListener;
use Hasob\FoundationCore\Models\Organization;
use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;
use DMO\SavingsBond\Models\Offer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Listeners\OfferUpdatedListener;
use DMO\SavingsBond\Events\OfferDeleted;
use DMO\SavingsBond\Listeners\OfferDeletedListener;

class EventListenerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_Create_event_listener()
    {

        Event::fake([OfferCreated::class,]);

$org_id = Organization::create([  'org' => 'apptest', 'domain' => 'app-test-domain', 'full_url' => 'www.app-test-domain.test', 'subdomain' => 'app.app-test-domain.test', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

      $Data = Offer::create([ 
        'organization_id' => "$org_id",'status'=>'true','offer_title'=>'BOss',
        'price_per_unit'=>'20110230','max_units_per_investor'=>'4993',
        'interest_rate_pct'=>'3304','offer_start_date'=>'',
        'offer_end_date'=>'dv','offer_settlement_date'=>'',
        'offer_maturity_date'=>'','tenor_years'=>'' ]);
      Event::assertListening(
            OfferCreated::class,
            OfferCreatedListener::class
        );
      Event::assertDispatched(OfferCreated::class);

    }


      public function test_Update_event_listener(){

        Event::fake(OfferUpdated::class,);

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

      $DataUpdate=$findOffer->update(['offer_title'=>'New title','updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);   
      Event::assertListening(
        OfferUpdated::class,
        OfferUpdatedListener::class,
      );

      Event::assertDispatched(OfferUpdated::class);
    }

public function test_Delete_event_listener(){
    Event::fake(OfferDeleted::class);
      $org_id = Organization::create([  'org' => 'apptest', 'domain' => 'app-test-domain', 'full_url' => 'www.app-test-domain.test', 'subdomain' => 'app.app-test-domain.test', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

      $Data = Offer::create([ 
        'organization_id' => "$org_id",'status'=>'true','offer_title'=>'BOss',
        'price_per_unit'=>'20110230','max_units_per_investor'=>'4993',
        'interest_rate_pct'=>'3304','offer_start_date'=>'',
        'offer_end_date'=>'dv','offer_settlement_date'=>'',
        'offer_maturity_date'=>'','tenor_years'=>'' ]); 
      $findOffer=Offer::find($Data->id);
      // $this->assertNotEmpty( $findOffer);

      $DataUpdate=$findOffer->delete($Data->id);   
       Event::assertListening(
        OfferDeleted::class,
        OfferDeletedListener::class,
    );
       Event::assertDispatched(OfferDeleted::class);
    }
}
