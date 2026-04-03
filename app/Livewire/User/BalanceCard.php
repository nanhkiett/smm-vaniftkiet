<?php

namespace App\Livewire\User;

use Livewire\Component;

class BalanceCard extends Component
{
    /**
     * Dùng lazy loading (Chiêu 3 của Senior).
     * Hiện skeleton trước, data lấy sau.
     */
    public function placeholder()
    {
        return view('livewire.placeholders.card-skeleton');
    }

    public function render()
    {
        return <<<'HTML'
        <div class="card card-flush shadow-sm h-md-100 mb-7 border-0 bg-dark overflow-hidden" style="background: linear-gradient(135deg, #2b3a4a 0%, #171d24 100%);">
            <!--begin::Decoration-->
            <div class="position-absolute top-0 end-0 p-5 opacity-10">
                <i class="ki-duotone ki-chart-pie-3 fs-5hx text-white"></i>
            </div>
            
            <!--begin::Header-->
            <div class="card-header pt-7 position-relative z-index-1">
                <div class="card-title d-flex flex-column">
                    <div class="d-flex align-items-center mb-1">
                        <span class="fs-4 fw-bold text-gray-500 me-2 mt-n1">VNĐ</span>
                        <span class="fs-2hx fw-bolder text-white me-2 lh-1 ls-n2">1.500.000</span>
                        <span class="badge badge-light-primary fw-bold text-uppercase fs-8 px-2">ĐỐI TÁC HỢP LỆ</span>
                    </div>
                    <span class="text-gray-500 fw-semibold fs-7 text-uppercase ls-1">SỐ DƯ TÀI KHOẢN HIỆN TẠI</span>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Card body-->
            <div class="card-body pt-5 pb-5 position-relative z-index-1">
                <div class="d-flex flex-column mt-auto w-100">
                    <div class="d-flex justify-content-between w-100 mt-auto mb-3">
                        <span class="fw-bold fs-8 text-white text-uppercase ls-1">TIẾN TRÌNH NÂNG CẤP HẠNG</span>
                        <span class="fw-bold fs-8 text-primary">PLATINUM (80%)</span>
                    </div>
                    <div class="h-6px mx-3 w-100 bg-white bg-opacity-10 rounded">
                        <div class="bg-primary rounded h-6px shadow-sm" role="progressbar" style="width: 80%; box-shadow: 0 0 15px rgba(0,180,255,0.4);" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!--end::Card body-->

            <!--begin::Card footer-->
            <div class="card-footer pt-2 pb-7 position-relative z-index-1">
                <div class="separator separator-dashed border-white opacity-10 mb-6"></div>
                <div class="d-flex flex-stack">
                    <div class="d-flex align-items-center me-2">
                        <div class="symbol symbol-40px symbol-circle me-3">
                            <span class="symbol-label bg-white bg-opacity-5 border border-white border-opacity-10">
                                <i class="ki-duotone ki-user-square fs-2 text-white"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fs-6 text-white fw-bold">Admin_SMM_Vietnam</span>
                            <span class="fs-8 text-gray-400 fw-bold">ID: SM-****-****-77</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary fw-bold px-5 py-2 text-uppercase fs-8 shadow-sm">
                        NẠP THÊM
                    </a>
                </div>
            </div>
            <!--end::Card footer-->
        </div>
        HTML;
    }
}
