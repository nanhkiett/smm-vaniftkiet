<?php

namespace App\Actions\Order;

use App\Models\Service;

/**
 * Tính phí đơn SMM: (rate / 1000) × quantity — một nguồn sự thật cho panel.
 */
class ComputeOrderChargeAction
{
    public function execute(?Service $service, int $quantity): float
    {
        if (!$service || $quantity < 1) {
            return 0.0;
        }

        return (float) (($service->price / 1000) * $quantity);
    }
}
