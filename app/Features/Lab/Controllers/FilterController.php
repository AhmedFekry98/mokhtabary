<?php

namespace App\Features\Lab\Controllers;

use App\Features\Lab\Helpers\LabHelper;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct() {}

    /**
        * Display a listing of the resource.
        */
        public function filterLabTest(Request $request)
        {
            $idString = $request->query('ids', []);
            // Decode the JSON string into an array
            $idArray = json_decode($idString, true);

            // Get paginated results directly from LabHelper
            $result = LabHelper::getLabTestByIds($idArray);

            if (is_string($result)) {
                return $this->badResponse(
                    message: $result
                );
            }

            // Directly return the result as it's already paginated and grouped
            return $this->okResponse(
            $result,
                "Success api call"
            );

        }
}
