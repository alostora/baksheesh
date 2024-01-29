<?php

namespace Admin\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Lang;

class DashboardResource extends JsonResource
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

            'count_active_clients' => $this['count_active_clients'],

            'count_active_employees' => $this['count_active_employees'],

            'count_active_companies' => $this['count_active_companies'],

            'month_income' => $this['month_income'] . ' ' .  Lang::get('employee_wallet.SAR'),

            'year_income' => $this['year_income'] . ' ' .  Lang::get('employee_wallet.SAR'),

            'current_amount' => $this['current_amount'] . ' ' .  Lang::get('employee_wallet.SAR'),
        ];
    }
}
