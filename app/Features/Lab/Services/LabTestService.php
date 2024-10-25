<?php

namespace App\Features\Lab\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Lab\Models\LabTest;
use App\Features\Lab\Models\Test;
use App\Features\User\Models\User;

class LabTestService
{
    private static $model = LabTest::class;

    public function __construct(
        private TestService $testService
    )
    {}
    /**
     * Get All useing lab_id = user_id with role master lab
     */
    public function getLabTests(string $labId)
    {

        $lab = User::find($labId);

        // Get all tests using testService
        $tests =Test::with(['labTest' => function($query) use ($labId) {
            $query->where('lab_id', $labId);
        }])->paginate(10); // You can adjust the number of items per page

        // Return the paginated results as a resource collection
        return [
            'lab_info' => $lab,
            'tests' => $tests,
        ];


    }

    /**
     * Create One
     */
    public function updateOrCreateLabTest(TDO $tdo)
    {
        try {
            $creationData = collect($tdo->all(true))->except([
                // exclude any keys if needed
            ])->toArray();

            // Define the matching criteria for the "test_id" and "lab_id" columns
            $matchingCriteria = [
                'test_id' => $creationData['test_id'],
                'lab_id'  => $creationData['lab_id'],
            ];

            // Remove the matching criteria from the creation data as they are used for finding the record
            $updateData = collect($creationData)->except(['test_id', 'lab_id'])->toArray();

            // Use updateOrCreate to either update the record if it exists or create a new one
            $labTest = self::$model::updateOrCreate($matchingCriteria, $updateData);

            // Perform any additional logic after the record is created/updated
            return $labTest;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getLabTestById(string $labTestId)
    {
        try {
            $labTest =  self::$model::find($labTestId);
            if (! $labTest) return "No model with id $labTestId";
            return $labTest;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
