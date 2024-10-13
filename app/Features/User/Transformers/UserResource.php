<?php

namespace App\Features\User\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        if(request('guard') == "family"){ // user request gurad to family not have auth in user model
            $data['info'] = $request->except('email','phone');
            return $data;
        }

        if($this->role->name == "client"){
            $data['info'] = $this->clientDetail;
        }

        if($this->role->name == "lab"){
            $data['info'] = $this->labDetail;
        }

        if($this->role->name == "radiology"){
            $data['info'] = $this->radiologyDetail;
        }


        // if($this->role->name == "labBranch"){

        // }

        // if($this->role->name == "radiologyBranch"){

        // }
        $data['phone_verified_at']  = $this->role->name == 'admin' || $this->role->name == 'employee' ?  now() : $this->phone_verified_at ?? null;
        return $data;

    }
}
