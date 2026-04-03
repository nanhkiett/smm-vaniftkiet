<?php

namespace App\Livewire\Admin;

use App\Actions\Admin\Dashboard\FetchDashboardOverviewAction;
use Livewire\Component;

class DashboardStats extends Component
{
    public function render(FetchDashboardOverviewAction $overview): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.dashboard-stats', $overview->execute());
    }
}
