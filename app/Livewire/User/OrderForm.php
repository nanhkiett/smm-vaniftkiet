<?php

namespace App\Livewire\User;

use App\Actions\Catalog\BuildCategoryPickerOptionsAction;
use App\Actions\Catalog\BuildServicePickerOptionsAction;
use App\Actions\Catalog\FetchCategoriesByPlatformAction;
use App\Actions\Catalog\FetchPlatformsAction;
use App\Actions\Catalog\FetchServiceCatalogAction;
use App\Actions\Catalog\FetchServicesByCategoryAction;
use App\Actions\Order\ComputeOrderChargeAction;
use App\Models\Service;
use Livewire\Component;

class OrderForm extends Component
{
    public $platforms = [];
    public $categories = [];
    public $services = [];
    public $allServices = [];

    public $platform_id;
    public $category_id;
    public $service_id;
    public $search_query;

    public $selectedService = null;
    public $quantity = 1;
    public $totalPrice = 0;

    private FetchPlatformsAction $fetchPlatforms;
    private FetchServiceCatalogAction $fetchServiceCatalog;
    private FetchCategoriesByPlatformAction $fetchCategoriesByPlatform;
    private FetchServicesByCategoryAction $fetchServicesByCategory;
    private BuildCategoryPickerOptionsAction $buildCategoryPickerOptions;
    private BuildServicePickerOptionsAction $buildServicePickerOptions;
    private ComputeOrderChargeAction $computeOrderCharge;

    public function boot(
        FetchPlatformsAction $fetchPlatforms,
        FetchServiceCatalogAction $fetchServiceCatalog,
        FetchCategoriesByPlatformAction $fetchCategoriesByPlatform,
        FetchServicesByCategoryAction $fetchServicesByCategory,
        BuildCategoryPickerOptionsAction $buildCategoryPickerOptions,
        BuildServicePickerOptionsAction $buildServicePickerOptions,
        ComputeOrderChargeAction $computeOrderCharge,
    ): void {
        $this->fetchPlatforms = $fetchPlatforms;
        $this->fetchServiceCatalog = $fetchServiceCatalog;
        $this->fetchCategoriesByPlatform = $fetchCategoriesByPlatform;
        $this->fetchServicesByCategory = $fetchServicesByCategory;
        $this->buildCategoryPickerOptions = $buildCategoryPickerOptions;
        $this->buildServicePickerOptions = $buildServicePickerOptions;
        $this->computeOrderCharge = $computeOrderCharge;
    }

    public function mount(): void
    {
        $this->platforms = $this->fetchPlatforms->execute();
        $this->allServices = $this->fetchServiceCatalog->execute();
    }

    public function updatedPlatformId($value): void
    {
        if (empty($value)) {
            return;
        }

        $this->categories = $this->fetchCategoriesByPlatform->execute($value);
        $this->category_id = null;
        $this->service_id = null;
        $this->services = [];
        $this->selectedService = null;

        $this->dispatch('platform-updated', [
            'options' => $this->buildCategoryPickerOptions->execute($this->categories),
        ]);
    }

    public function updatedCategoryId($value): void
    {
        if (empty($value)) {
            return;
        }

        $this->services = $this->fetchServicesByCategory->execute($value);
        $this->service_id = null;
        $this->selectedService = null;

        $this->dispatch('category-updated', [
            'options' => $this->buildServicePickerOptions->execute($this->services),
        ]);
    }

    public function updatedServiceId($value): void
    {
        $this->selectedService = $value ? Service::find($value) : null;
        $this->recalculateCharge();
    }

    public function updatedQuantity(): void
    {
        $this->recalculateCharge();
    }

    private function recalculateCharge(): void
    {
        $this->totalPrice = $this->computeOrderCharge->execute(
            $this->selectedService,
            (int) $this->quantity
        );
    }

    public function render()
    {
        return view('livewire.user.order-form');
    }
}
