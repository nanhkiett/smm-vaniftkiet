"use strict";

/**
 * Trang hồ sơ (client): Swal `notify` đã đăng ký trong assets/custom/spa-optimize.js.
 * Tránh đăng ký trùng Livewire.on khiến popup lặp hoặc kích hoạt sai sau wire:navigate.
 *
 * Thêm init chỉ cho profile (chart, sticky tab, …) bên trong listener livewire:navigated nếu cần.
 */
