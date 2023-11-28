@extends('layout.layout-admin')

@section('title', 'Jadwal Sidang')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-jadwal')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection
