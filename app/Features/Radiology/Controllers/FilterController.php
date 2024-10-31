<?php

namespace App\Features\Radiology\Controllers;

use App\Features\Radiology\Helpers\RadiologyHelper;
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
        public function filterRadiologyXray(Request $request)
        {
            $idString = $request->query('ids', []);
            // Decode the JSON string into an array
            $idArray = json_decode($idString, true);

            // Get paginated results directly from LabHelper
            $result = RadiologyHelper::getRadiologytByIds($idArray);

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
