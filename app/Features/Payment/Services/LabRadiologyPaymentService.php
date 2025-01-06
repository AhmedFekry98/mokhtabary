<?php

namespace App\Features\Payment\Services;

use App\Features\Order\Helpers\CalculateContractAmountHelper;
use App\Features\Payment\Helpers\CalculateLabRadiologyPaymentHelper;
use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\LabRadiologyPayment;

class LabRadiologyPaymentService
{
    private static $model = LabRadiologyPayment::class;

    /**
     * Get All
     */
    public function getLabRadiologyPayments()
    {
        try {
            $labRadiologyPayments =  self::$model::get();

            return $labRadiologyPayments;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeLabRadiologyPayment(TDO $tdo)
    {
        try {
            $creationData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            $receiverId = $creationData['receiver_id'];

            $helperContractAmount = new CalculateContractAmountHelper(
                new \App\Features\Order\Services\OrderService(),
                new \App\Features\Payment\Services\LabRadiologyPaymentService(),
                new \App\Features\User\Services\AuthService()
            );
            //  payment helper to calculated Lab & radilogy amount and get amount for mokhtabary
            $helperLabRadiologyPayment = new CalculateLabRadiologyPaymentHelper(
                new \App\Features\CompanyProfile\Services\BasicInformationService(),
            );
            // get receiver payments summary
            $summary = $helperContractAmount->getReceiverPaymentsSummary($receiverId);
            // get calculated Lab & RadilogyPayment
            $calculatedAmounts = $helperLabRadiologyPayment->calculatePaymentAmounts($summary);

            if (isset($calculatedAmounts['error'])) {
                return $calculatedAmounts['error'];
            }

            $creationData = array_merge($creationData, $calculatedAmounts);

            $labRadiologyPayment = self::$model::create($creationData);

            return $labRadiologyPayment;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * getLabRadiologyPaymentByReceiverId
     */
    public function getLabRadiologyPaymentByReceiverId(string $receiverId)
    {

        try {
            $labRadiologyPayment =  self::$model::where('receiver_id', $receiverId)->get();
            if (! $labRadiologyPayment) return "No model with id $receiverId";
            return $labRadiologyPayment;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
