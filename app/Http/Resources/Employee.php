<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'IDNumber' => $this->IDNumber,
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'MiddleName' => $this->MiddleName,
            'Address' => $this->Address,
            'PhoneNo' => $this->PhoneNo,
            'Status' => $this->Status,
        ];
    }
}
