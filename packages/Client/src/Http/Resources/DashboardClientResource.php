<?php

namespace Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'count_active_employees' => $this['count_active_employees'],

            'count_active_companies' => $this['count_active_companies'],

            'month_income' => $this['month_income'],

            'year_income' => $this['year_income'],

            'current_amount' => $this['current_amount'],
        ];
    }
}
