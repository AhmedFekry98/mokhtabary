<?php

namespace App\Features\Lab\Filter;

use App\Features\Lab\Models\LabTest;

class LabTestFilter
{
    private static $model = LabTest::class;

    public function filterByTestIds(array $ids)
    {
        $result = self::$model::whereIn('test_id', $ids)->paginate(10);

        // Group lab data by `labId`
        $labData = $result->groupBy('lab_id')->map(function ($labGroup) {
            $lab = $labGroup->first()->lab; // Assuming each group has the same `lab` model, pick the first

            // Calculate total `beforePrice` and `afterPrice` for each lab
            $totalBeforePrice = $labGroup->sum('before_price');
            $totalAfterPrice = $labGroup->sum('after_price');

            return [
                // Totals
                'totalBeforePrice' => $totalBeforePrice,
                'totalAfterPrice'  => $totalAfterPrice,
                'id'             => $lab->id,
                'name'             => $lab->labDetail->name,
                'country_info'     => $lab->labDetail->country()->first(['id', 'name_ar', 'name_en']),
                'city_info'        => $lab->labDetail->city()->first(['id', 'name_ar', 'name_en']),
                'governorate_info' => $lab->labDetail->governorate()->first(['id', 'name_ar', 'name_en']),
                'street'           => $lab->labDetail->street,
                'description'      => $lab->labDetail->description,
                'created_at'       => $lab->created_at,
                'updated_at'       => $lab->updated_at,
                'phone_verified_at'=> now(),
                'role'             => $lab->role->name,
                'img'              => $lab->getFirstMediaUrl('users') ?: null,

                // Branches information
                'branches'         => $lab->labDetail->children->map(function ($branch) {
                    return [
                        "id"               => $branch->id,
                        "branch_id"        => $branch->lab_id,
                        "parent_id"        => $branch->parent_id,
                        "email"            => $branch->user->email ?? null,
                        "phone"            => $branch->user->phone ?? null,
                        "name"             => $branch->name,
                        'country_info'     => $branch->country()->first(['id', 'name_ar', 'name_en']),
                        'city_info'        => $branch->city()->first(['id', 'name_ar', 'name_en']),
                        'governorate_info' => $branch->governorate()->first(['id', 'name_ar', 'name_en']),
                        "street"           => $branch->street,
                        "description"      => $branch->description,
                        "created_at"       => $branch->created_at,
                        "updated_at"       => $branch->updated_at,
                    ];
                }) ?? null,

                // Details and totals
                'details'          => $labGroup->map(function ($labTest) {
                    return [
                        "id"             => $labTest->id,
                        "test_id"        => $labTest->test_id,
                        "lab_id"         => $labTest->lab_id,
                        "contract_price" => $labTest->contract_price,
                        "before_price"   => $labTest->before_price,
                        "after_price"    => $labTest->after_price,
                        "offer_price"    => $labTest->offer_price,
                        "created_at"     => $labTest->created_at,
                        "updated_at"     => $labTest->updated_at,
                    ];
                }),


            ];
        });

        return [
            'per_page'          => $result->count(),
            'current_page'      => $result->currentPage() ?? null,
            'last_page'         => $result->lastPage(),
            'next_page_url'     => $result->nextPageUrl(),
            'items'             => $labData->values(),// Reset indices for JSON output
        ];
    }
}
