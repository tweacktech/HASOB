<?php

// namespace Tests\Feature\Bond;
namespace DMO\SavingsBond;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DMO\SavingsBond\Models\Offer;
use DMO\SavingsBond\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;





class RelationshipTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Relationship()
    {
        $Offer=new Offer;

        $relationship=$Offer->Subscription();
        $foreign_key='offer_id';
        $relat_model=$relationship->getRelated();

      // $this->assertInstanceOf(BelongsTo::class,$relationship);
      $this->assertInstanceOf(Subscription::class,$relationship->getRelated());
      $this->assertEquals($foreign_key,$relationship->getForeignKeyName());
      $this->assertTrue(Schema::hasColumns($relationship->getRelated()->getTable(), array($foreign_key)));

    }
}
