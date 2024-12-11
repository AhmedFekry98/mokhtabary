<?php

namespace App\Features\Order\Services;

use App\Features\Order\Helpers\CalculatedAmountOrderHeleper;
use Graphicode\Standard\TDO\TDO;
use App\Features\Order\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    private static $model = Order::class;

    /**
     * Get All
     */
    public function getOrders()
    {
        try {
            $userRole = auth()->user()->role->name;
            if($userRole === 'admin'){
                $orders =  self::$model::get();
            }else{
                $orders = $this->getOrdersGroupedByPerson();
            }
            return $orders;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeOrder(TDO $tdo)
    {
        try {
            DB::beginTransaction();
            $creationData = $tdo->all();
            $creationData['client_id'] = auth()->user()->id;

            $receiverid = $creationData['receiver_id'];
            $orderType  = $creationData['order_type'];
            $ids        =  $creationData['order_info'];
            $couponId   = $creationData['coupon_id'];

            // Call the helper function to calculate the amount
            $calculatedAmountOrder = CalculatedAmountOrderHeleper::calculatedAmountlOrder($receiverid,$orderType,$ids,$couponId);
            // data camming  helper function to calculate the amount

            $creationData['amount'] = $calculatedAmountOrder['amount'];
            $creationData['promo_code'] = $calculatedAmountOrder['promo_code'];
            $creationData['discount_percentage'] = $calculatedAmountOrder['discount_percentage'];
            $creationData['discount_value'] = $calculatedAmountOrder['discount_value'];
            //  create order
            $order =  self::$model::create($creationData);

            /* check order type is test or xray to add it in testorder or xray order*/
            switch ($orderType) {
                case 'test':
                    foreach ($ids  as $orderInfo) {
                        $order->testOrder()->create(['lab_test_id' => $orderInfo['id']]);
                    }
                    break;
                case 'xray':
                    foreach ($ids  as $orderInfo) {
                        $order->xrayOrder()->create(['radiology_x_ray_id' => $orderInfo['id']]);
                    }
                    break;
                default:
                    throw new \InvalidArgumentException("Invalid creadintioal");
            }
            DB::commit();
            return $order;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getOrderById(string $orderId)
    {
        try {
            $order =  self::$model::find($orderId);
            if (! $order) return "No model with id $orderId";
            return $order;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    /**
     * Delete One By Id
     */
    public function deleteOrderById(string $orderId)
    {
        try {

            // get model to delete by id
            $order =  $this->getOrderById($orderId);
            if (is_string($order)) return $order;
            $deleted = $order->delete();

            return $order;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // update order status
    public function updateStatusOrderById(string $orderId,TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
                )->except([
                    // ignore any key?
                    ])->toArray();

                    // get model to delete by id
                    $order =  $this->getOrderById($orderId);
                    if (is_string($order)) return $order;
                    $order->status =$updateData['status'];
                    $order->save();
            return $this->getOrderById($orderId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function getOrdersGroupedByPerson()
    {
        try{
            $type = request('type') ?? null;
            $userId = auth()->user()->id;

            $query = self::$model::where('client_id', $userId);

            if ($type !== null) {
                $query->where('order_type', $type);
            }

            $orders = $query->get();
            return $orders;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function getOrdersCount()
    {
        try {
            $userRole = auth()->user()->role->name;
            $userId = auth()->user()->id;

            $baseQuery = $userRole === 'admin'
                ? self::$model::query()
                : self::$model::where('client_id', $userId);

            return [
                'total' => (clone $baseQuery)->count(),
                'test' => (clone $baseQuery)->where('order_type', 'test')->count(),
                'xray' => (clone $baseQuery)->where('order_type', 'xray')->count()
            ];

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
