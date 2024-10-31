<?php

namespace App\Features\Order\Services;

use App\Features\Lab\Models\Test;
use Graphicode\Standard\TDO\TDO;
use App\Features\Order\Models\PrescriptionOrder;
use App\Features\Radiology\Models\XRay;
use Illuminate\Support\Facades\DB;

class PrescriptionOrderService
{
    private static $model = PrescriptionOrder::class;

    /**
     * Get All
     */
    public function getPrescriptionOrders()
    {
        try {
            $prescriptionOrders =  self::$model::get();

            return $prescriptionOrders;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storePrescriptionOrder(TDO $tdo)
    {
        try {
            $models = [
                'test' => Test::class,
                'xray' => XRay::class,
            ];
            DB::beginTransaction();

            $creationData = collect(
                $tdo->all(true)
            )->except([
                'img'
            ])->toArray();

            $orderTypes = $creationData['order_type'];
            $medicals =  $creationData['medicals'];
            $creationData['client_id'] = auth()->user()->id;


            //  create prescriptionOrder
            $prescriptionOrder =  self::$model::create($creationData);

            if ($tdo->img) {
                $prescriptionOrder->addMedia($tdo->img)
                    ->toMediaCollection('prescription');
            }

            foreach ($medicals  as $medical) {
                $prescriptionOrder->prescriptionMediacl()->create([
                    'medicalable_id' => $medical['medicalable_id'],
                    'medicalable_type' => $models[$orderTypes],
                ]);

            }

            DB::commit();

            return $prescriptionOrder;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getPrescriptionOrderById(string $prescriptionOrderId)
    {
        try {
            $prescriptionOrder =  self::$model::find($prescriptionOrderId);
            if (! $prescriptionOrder) return "No model with id $prescriptionOrderId";
            return $prescriptionOrder;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deletePrescriptionOrderById(string $prescriptionOrderId)
    {
        try {

            // get model to delete by id
            $prescriptionOrder =  $this->getPrescriptionOrderById($prescriptionOrderId);
            if (is_string($prescriptionOrder)) return $prescriptionOrder;
            $deleted = $prescriptionOrder->delete();

            return $prescriptionOrder;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
