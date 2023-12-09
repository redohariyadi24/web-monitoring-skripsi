@extends('layout.layout-admin')

@section('title', 'Data Bimbingan')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-bimbingan')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection
