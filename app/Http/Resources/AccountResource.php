<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'account_type' => $this->accountType,
            'branche' => $this->branch,
            'account_number' => $this->account_number,
            'balance' => $this->balance,
            'status' => $this->status,
        ];
    }
}
