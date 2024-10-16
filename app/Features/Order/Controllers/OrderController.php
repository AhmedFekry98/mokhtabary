<?php

namespace App\Features\Order\Controllers;

use App\Features\Order\Requests\StOrderRequest;
use App\Features\Order\Requests\UpOrderRequest;
use App\Features\Order\Services\OrderService;
use App\Features\Order\Transformers\OrderCollection;
use App\Features\Order\Transformers\OrderResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private OrderService $orderService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->orderService->getOrders();

        return $this->okResponse(
            OrderResource::collection($result),
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StOrderRequest $request)
    {
        $result = $this->orderService->storeOrder(TDOFacade::make($request));

        return $this->okResponse(
            OrderResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->orderService->getOrderById($id);

        return $this->okResponse(
            OrderResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpOrderRequest $request, string $id)
    {
        $result = $this->orderService->updateOrderById($id,TDOFacade::make($request));

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
        $result = $this->orderService->deleteOrderById($id);

        return $this->okResponse(
            OrderResource::make($result),
            "Success api call"
        );
    }
}
