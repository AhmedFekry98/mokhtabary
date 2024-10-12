<?php


namespace App\Features\User\Requests\Services\Validation;

use App\Features\User\Requests\Services\Validation\Contracts\GuardValidationStrategy;
use App\Features\User\Requests\Services\Validation\Guards\ClientValidation;
use App\Features\User\Requests\Services\Validation\Guards\FamilyValidation;
use App\Features\User\Requests\Services\Validation\Guards\LabValidation;
use App\Features\User\Requests\Services\Validation\Guards\RadiologyValidation;

class GuardContext
{
    protected GuardValidationStrategy $strategy;

    public function __construct(string $guard)
    {
       
        switch ($guard) {
            case 'client':
                $this->strategy = new ClientValidation();
                break;
            case 'family':
                $this->strategy = new FamilyValidation();
                break;
            case 'lab':
            case 'labBranch':
                $this->strategy = new LabValidation($guard);
                break;
             
            case 'radiology':
            case 'radiologyBranch':
                $this->strategy = new RadiologyValidation($guard);
                break;
            default:
                throw new \InvalidArgumentException("Invalid guard type provided");
        }
    }

    public function getRules(): array
    {
        return $this->strategy->rules();
    }
}
