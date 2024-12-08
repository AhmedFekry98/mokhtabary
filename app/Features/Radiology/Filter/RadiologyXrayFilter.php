<?php

namespace App\Features\Radiology\Filter;


use App\Features\Radiology\Models\RadiologyxRay;

class RadiologyXrayFilter
{
    private static $model = RadiologyxRay::class;

    public function filterByXrayIds(array $ids)
    {
        $result = self::$model::whereIn('x_ray_id', $ids)->paginate(10);

        // Group radiology data by `radiology_id`
        $radiologyData = $result->groupBy('radiology_id')->map(function ($radiologyGroup) {
            $radiology = $radiologyGroup->first()->radiology; // Assuming each group has the same `radiology` model, pick the first

            // Calculate total `beforePrice` and `afterPrice` for each radiology
            $totalBeforePrice = $radiologyGroup->sum('before_price');
            $totalAfterPrice = $radiologyGroup->sum('after_price');

            return [
                // Totals
                'totalBeforePrice' => $totalBeforePrice,
                'totalAfterPrice'  => $totalAfterPrice,
                'id'                => $radiology->id,
                'name'             => $radiology->radiologyDetail->name,
                'country_info'     => $radiology->radiologyDetail->country()->first(['id', 'name_ar', 'name_en']),
                'city_info'        => $radiology->radiologyDetail->city()->first(['id', 'name_ar', 'name_en']),
                'governorate_info' => $radiology->radiologyDetail->governorate()->first(['id', 'name_ar', 'name_en']),
                'street'           => $radiology->radiologyDetail->street,
                'description'      => $radiology->radiologyDetail->description,
                'created_at'       => $radiology->created_at,
                'updated_at'       => $radiology->updated_at,
                'phone_verified_at'=> now(),
                'role'             => $radiology->role->name,
                'img'              => $radiology->getFirstMediaUrl('users') ?: null,

                // Branches information
                'branches'         => $radiology->radiologyDetail->children->map(function ($branch) {
                    return [
                        "id"               => $branch->id,
                        "branch_id"        => $branch->radiology_id,
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
                'details'          => $radiologyGroup->map(function ($radiologyXray) {
                    return [
                        "id"             => $radiologyXray->id,
                        "x_ray_id"        => $radiologyXray->x_ray_id,
                        "radiology_id"   => $radiologyXray->radiology_id,
                        "contract_price" => $radiologyXray->contract_price,
                        "before_price"   => $radiologyXray->before_price,
                        "after_price"    => $radiologyXray->after_price,
                        "offer_price"    => $radiologyXray->offer_price,
                        "created_at"     => $radiologyXray->created_at,
                        "updated_at"     => $radiologyXray->updated_at,
                    ];
                }),


            ];
        });

        return [
            'per_page'          => $result->count(),
            'current_page'      => $result->currentPage() ?? null,
            'last_page'         => $result->lastPage(),
            'next_page_url'     => $result->nextPageUrl(),
            'items'             => $radiologyData->values(),// Reset indices for JSON output
        ];
    }
}
