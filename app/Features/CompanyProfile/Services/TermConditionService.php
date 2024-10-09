<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\TermCondition;

class TermConditionService
{
    private static $model = TermCondition::class;

    /**
     * Get All
     */
    public function getTermConditions()
    {
        try {
            $termConditions =  self::$model::get();

            return $termConditions;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeTermCondition(TDO $tdo)
    {
        try {
            $creationData = $tdo->all();

            // manobolate the data before creation?

            $termCondition =  self::$model::create($creationData);

            // write any logic after creation?

            return $termCondition;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getTermConditionById(string $termConditionId)
    {
        try {
            $termCondition =  self::$model::find($termConditionId);
            if (! $termCondition) return "No model with id $termConditionId";
            return $termCondition;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateTermConditionById(string $termConditionId, TDO $tdo)
    {
        try {
            $updateData = $tdo->all();

            // manobolate the data before update?

            $termCondition =  $this->getTermConditionById($termConditionId);
            if (is_string($termCondition)) return $termCondition;
            $termCondition->update($updateData);

            // write any logic after update?

            return $termCondition;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteTermConditionById(string $termConditionId)
    {
        try {

            // get model to delete by id
            $termCondition =  $this->getTermConditionById($termConditionId);
            if (is_string($termCondition)) return $termCondition;
            $deleted = $termCondition->delete();

            return $termCondition;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
