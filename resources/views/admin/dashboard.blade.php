@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')
@section('breadcrumb-current', 'Tổng quan')

@section('content')
    <!--begin::Dashboard Content-->
    <livewire:admin.dashboard-stats />
    <!--end::Dashboard Content-->
@endsection
