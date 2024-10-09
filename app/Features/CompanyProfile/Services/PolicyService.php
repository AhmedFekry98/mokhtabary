<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\Policy;

class PolicyService
{
    private static $model = Policy::class;

    /**
     * Get All
     */
    public function getPolicies()
    {
        try {
            $policies =  self::$model::get();

            return $policies;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storePolicy(TDO $tdo)
    {
        try {
            $creationData = $tdo->all();

            // manobolate the data before creation?

            $policy =  self::$model::create($creationData);

            // write any logic after creation?

            return $policy;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getPolicyById(string $policyId)
    {
        try {
            $policy =  self::$model::find($policyId);
            if (! $policy) return "No model with id $policyId";
            return $policy;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updatePolicyById(string $policyId, TDO $tdo)
    {
        try {
            $updateData = $tdo->all();

            // manobolate the data before update?

            $policy =  $this->getPolicyById($policyId);
            if (is_string($policy)) return $policy;
            $policy->update($updateData);

            // write any logic after update?

            return $policy;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deletePolicyById(string $policyId)
    {
        try {

            // get model to delete by id
            $policy =  $this->getPolicyById($policyId);
            if (is_string($policy)) return $policy;
            $deleted = $policy->delete();

            return $policy;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
