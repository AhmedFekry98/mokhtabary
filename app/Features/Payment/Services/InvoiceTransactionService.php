<?php

namespace App\Features\Payment\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\InvoiceTransaction;

class InvoiceTransactionService
{
    private static $model = InvoiceTransaction::class;

    /**
     * Get All
     */
    public function getInvoiceTransactions()
    {
        try {
            $invoiceTransactions =  self::$model::get();

            return $invoiceTransactions;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeInvoiceTransaction(TDO $tdo)
    {

        try {
            $creationData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before creation?

            $invoiceTransaction =  self::$model::create($creationData);

            // write any logic after creation?

            return $invoiceTransaction;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getInvoiceTransactionById(string $invoiceTransactionId)
    {
        try {
            $invoiceTransaction =  self::$model::find($invoiceTransactionId);
            if (! $invoiceTransaction) return "No model with id $invoiceTransactionId";
            return $invoiceTransaction;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateInvoiceTransactionById(string $invoiceTransactionId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before update?

            $invoiceTransaction =  $this->getInvoiceTransactionById($invoiceTransactionId);
            if (is_string($invoiceTransaction)) return $invoiceTransaction;
            $invoiceTransaction->update($updateData);

            // write any logic after update?

            return $invoiceTransaction;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteInvoiceTransactionById(string $invoiceTransactionId)
    {
        try {

            // get model to delete by id
            $invoiceTransaction =  $this->getInvoiceTransactionById($invoiceTransactionId);
            if (is_string($invoiceTransaction)) return $invoiceTransaction;
            $deleted = $invoiceTransaction->delete();

            return $deleted;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
