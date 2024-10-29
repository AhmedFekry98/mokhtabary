<?php

namespace App\Features\Auditing\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Auditing\Models\UserLog;

class UserLogService
{
    private static $model = UserLog::class;

    /**
     * Get All
     */
    public function getUserLogs()
    {
        try {
            $userLogs =  self::$model::get();

            return $userLogs;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeUserLog(TDO $tdo)
    {
        try {
            $creationData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before creation?

            $userLog =  self::$model::create($creationData);

            // write any logic after creation?

            return $userLog;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getUserLogById(string $userLogId)
    {
        try {
            $userLog =  self::$model::find($userLogId);
            if (! $userLog) return "No model with id $userLogId";
            return $userLog;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateUserLogById(string $userLogId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before update?

            $userLog =  $this->getUserLogById($userLogId);
            if (is_string($userLog)) return $userLog;
            $userLog->update($updateData);

            // write any logic after update?

            return $userLog;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteUserLogById(string $userLogId)
    {
        try {

            // get model to delete by id
            $userLog =  $this->getUserLogById($userLogId);
            if (is_string($userLog)) return $userLog;
            $deleted = $userLog->delete();

            return $deleted;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
