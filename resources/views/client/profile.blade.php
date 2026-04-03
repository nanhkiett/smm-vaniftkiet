@extends('layouts.client.app')

@section('title', 'Cấu hình tài khoản - ' . config('app.name'))
@section('page-title', 'Thiết lập tài khoản')


@section('content')
    <!-- Tích hợp Profile Management Engine -->
    <livewire:user.profile-manager />
@endsection
