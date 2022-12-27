<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\PaymentDetail;
use Hasob\FoundationCore\Models\PaymentDetailDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentDetailDeletedListener
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
     * @param  PaymentDetailDeleted  $event
     * @return void
     */
    public function handle(PaymentDetailDeleted $event)
    {
        //
    }
}
