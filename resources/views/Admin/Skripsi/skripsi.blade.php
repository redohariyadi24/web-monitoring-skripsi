@extends('layout.layout-admin')

@section('title', 'Progres Skripsi')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-skripsi')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection

