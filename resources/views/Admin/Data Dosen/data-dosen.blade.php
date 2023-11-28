@extends('layout.layout-admin')

@section('title', 'Data Dosen')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-dosen')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection