<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class AnalyticsComponent extends Component
{
    #[Title('Analytics | Admin')]

    public $minSpent = 5000;

    /**
     * INNOVATION: Utilizing Stored Procedures for Complex Analytics
     */
    public function getHighValueCustomers()
    {
        // Calling the SQL Stored Procedure directly for massive performance gains
        return DB::select("CALL GetHighValueCustomers(?)", [$this->minSpent]);
    }

    public function render()
    {
        return view('livewire.admin.analytics-component', [
            'highValueCustomers' => $this->getHighValueCustomers()
        ]);
    }
}
