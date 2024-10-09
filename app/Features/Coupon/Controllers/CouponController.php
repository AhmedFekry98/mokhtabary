<?php

namespace App\Features\Coupon\Controllers;

use App\Features\Coupon\Requests\StCouponRequest;
use App\Features\Coupon\Requests\UpStatusCouponRequest;
use App\Features\Coupon\Services\CouponService;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private CouponService $couponService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->couponService->getCoupons();

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StCouponRequest $request)
    {
        $result = $this->couponService->storeCoupon(TDOFacade::make($request));

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->couponService->getCouponById($id);

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }


    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->couponService->deleteCouponById($id);

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    public function getCouponByCode(string $code)
    {
        $result = $this->couponService->getCouponByCode($code);

        return $this->okResponse(
            $result,
            "Success api call"
        ); 
    }

    public function updateStatusCouponById(string $id , UpStatusCouponRequest $request)
    {
        $result = $this->couponService->updateStatusCouponById($id,TDOFacade::make($request));

        return $this->okResponse(
            $result,
            "Success api call"
        ); 
    }
}
