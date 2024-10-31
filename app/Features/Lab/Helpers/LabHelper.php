<?php

namespace App\Features\Lab\Helpers;

use App\Features\Lab\Filter\LabTestFilter;
use Exception;

class LabHelper
{
    /**
     * Write new log for user auditing
     *
     * @static log($action)
     * @param string $action The action of user.
     * @throws \Exception

     */
    public static function getLabTestByIds(array $ids)  // param ids = id of test
    {
        $labTestFilter = new LabTestFilter();
        $result = $labTestFilter->filterByTestIds($ids);
        return $result;
    }
}
