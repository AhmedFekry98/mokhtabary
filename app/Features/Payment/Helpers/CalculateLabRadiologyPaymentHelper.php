<?php

namespace App\Features\Payment\Helpers;

use App\Features\CompanyProfile\Services\BasicInformationService;

class CalculateLabRadiologyPaymentHelper
{
    private $basicInformationService;
    private $vat;
    private $discountPercentageMediscan;

    public function __construct(
        BasicInformationService $basicInformationService
    ) {
        $this->basicInformationService = $basicInformationService;
        $basicInformation = $this->basicInformationService->getBasicInformationById();

        $this->vat = $basicInformation['vat'];
        $this->discountPercentageMediscan = $basicInformation['discount_percentage_mediscan'];
    }

    public function calculatePaymentAmounts(array $summary)
    {
        try {
            $result = [];

            // Order total amount
            $result['total_amount_order'] = $summary['amount_order_total'];
            // Calculate receiver amounts
            $result['total_amount_receiver'] = $summary['contract_amount_total'];

            $result['tax_percentage'] = $this->discountPercentageMediscan;
            $result['tax_amount'] = $summary['contract_amount_total'] * $result['tax_percentage'] / 100;
            $result['amunt_after_taxes'] = $summary['contract_amount_total'] - $result['tax_amount'];

            // Calculate Mokhtabary amounts
            $result['total_amount_mokhtabary'] = $summary['amount_order_total'] - $summary['contract_amount_total'];
            $result['vat_precentage'] = $this->vat;
            $result['vat_amount'] = $result['total_amount_mokhtabary'] * $result['vat_precentage'] / 100;
            $result['amount_after_vat'] = $result['total_amount_mokhtabary'] - $result['vat_amount'];

            return $result;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
