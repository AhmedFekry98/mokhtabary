<?php

namespace App\Features\Order\Services;

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
            $orders =  self::$model::get();

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
            $orderTypes = $creationData['order_type'];
            $orderInfo =  $creationData['order_info'];
            $creationData['client_id'] = auth()->user()->id;

            //  create order
            $order =  self::$model::create($creationData);

            /* check order type is test or xray to add it in testorder or xray order*/
            switch ($orderTypes) {
                case 'test':
                    foreach ($orderInfo  as $orderInfo) {
                        $order->testOrder()->create(['lab_test_id' => $orderInfo['id']]);
                    }
                    break;
                case 'xray':
                    foreach ($orderInfo  as $orderInfo) {
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
}
