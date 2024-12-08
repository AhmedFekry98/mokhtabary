<?php

namespace App\Features\Radiology\Helpers;

use App\Features\Radiology\Filter\RadiologyXrayFilter;
use Exception;

class RadiologyHelper
{
    /**
     * Write new log for user auditing
     *
     * @static log($action)
     * @param string $action The action of user.
     * @throws \Exception

     */
    public static function getRadiologytByIds(array $ids)  // param ids = id of test
    {
        $radiologyXrayFilter = new RadiologyXrayFilter();
        $result = $radiologyXrayFilter->filterByXrayIds($ids);
        return $result;
    }
}
