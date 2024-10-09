<?php

namespace App\Features\Coupon\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Coupon\Models\Coupon;


class CouponService
{
    private static $model = Coupon::class;

    /**
     * Get All
     */
    public function getCoupons()
    {
        try {
            $coupons =  self::$model::get();

            return $coupons;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeCoupon(TDO $tdo)
    {
        try {
            $creationData = $tdo->all();

            // manobolate the data before creation?

            $coupon =  self::$model::create($creationData);

            // write any logic after creation?

            return $coupon;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getCouponById(string $couponId)
    {
        try {
            $coupon =  self::$model::find($couponId);
            if (! $coupon) return "No model with id $couponId";
            return $coupon;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteCouponById(string $couponId)
    {
        try {

            // get model to delete by id
            $coupon =  $this->getCouponById($couponId);
            if (is_string($coupon)) return $coupon;
            $deleted = $coupon->delete();

            return $coupon;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function getCouponByCode(string $code)
    {
        try{
            $coupon = self::$model::where('code',$code)
                ->where('expiration_date','>',now())
            ->where('discount_percentage','>',0)
            ->where('is_active',1)
            ->first();
            if(!$coupon){
                return 'Coupon expired';
            }
            return $coupon;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateStatusCouponByid(String $couponId , TDO $tdo)
    {
        try{
            $coupon = $this->getCouponById($couponId);
            $coupon->is_active = $tdo->is_active;
            $coupon->save();

            return $this->getCouponById($couponId);
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
