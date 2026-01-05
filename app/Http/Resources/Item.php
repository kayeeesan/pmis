<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'propertyno' => $this->propertyno,
            'item' => $this->item,
            'unit' => $this->unit,
            'descrip' => $this->descrip,
            'classid' => $this->classid,
            'yrlife' => $this->yrlife,
            'reorderpt' => $this->reorderpt,
            'reorderqty' => $this->reorderqty,
            'edate' => $this->edate,
            'itemtypeid' => $this->itemtypeid,
            'status' => $this->status,
            'criticalqty' => $this->criticalqty,
            'allow' => $this->allow,
            'propertycard' => $this->propertycard
        ];
    }
}
