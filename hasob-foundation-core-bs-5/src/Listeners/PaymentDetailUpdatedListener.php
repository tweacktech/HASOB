<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\PaymentDetail;
use Hasob\FoundationCore\Models\PaymentDetailUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentDetailUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentDetailUpdated  $event
     * @return void
     */
    public function handle(PaymentDetailUpdated $event)
    {
        //
    }
}
