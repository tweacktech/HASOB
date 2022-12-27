<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\PaymentDetail;
use Hasob\FoundationCore\Models\PaymentDetailCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentDetailCreatedListener
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
     * @param  PaymentDetailCreated  $event
     * @return void
     */
    public function handle(PaymentDetailCreated $event)
    {
        //
    }
}
