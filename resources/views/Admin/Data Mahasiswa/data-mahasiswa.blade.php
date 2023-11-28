@extends('layout.layout-admin')

@section('title', 'Data Mahasiswa')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-mahasiswa')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection