<?php


namespace App\Features\Order\Helpers;

use App\Features\Coupon\Services\CouponService;
use App\Features\Lab\Services\LabTestService;
use App\Features\Radiology\Services\RadiologyxRayService;

class CalculatedAmountOrderHeleper
{

    public static function calculatedAmountlOrder(string $receiverid, string $orderType, array $ids, ?string $couponId = null)
    {
        // Instantiate the service classes directly
        $couponService = new CouponService();
        $labTestService = new LabTestService();
        $radiologyxRayService = new RadiologyxRayService();

        $amount = 0;

        // Get lab tests or radiology x-ray orders
        switch ($orderType) {
            case "test":
                $orders = $labTestService->getLabTestByIds($receiverid, $ids);
                break;
            case "xray":
                $orders = $radiologyxRayService->getRadiologyxRayByIds($receiverid, $ids);
                break;
            default:
                throw new \InvalidArgumentException("Invalid order type: $orderType");
        }

        // Calculate amount from 'after_price'
        $amount = $orders->sum('after_price');

        // Apply coupon if available
        if ($couponId) {
            $coupon = $couponService->getCouponById($couponId);
            $discountValue = $amount * ($coupon->discount_percentage / 100);
            $amount -= $discountValue; // Apply percentage discount
        }

        // retun  data to create in order
        return [
            'amount'     => $amount ?? 0, // if not found data for order you get
            'promo_code' => $coupon->code ?? null, // if not have a coupon
            'discount_percentage' => $coupon->discount_percentage ?? null, // if not have a coupon
            'discount_value' => $discountValue ?? null, // if not have a coupon
        ];
    }
}
