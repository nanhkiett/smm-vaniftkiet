@extends('layouts.admin.app')

@section('title', 'Danh mục thành viên')
@section('page-title', 'Danh mục thành viên')
@section('breadcrumb-current', 'Thành viên')

@section('content')
    <livewire:admin.member-manager />
@endsection
