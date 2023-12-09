@extends('layout.layout-admin')

@section('title', 'Akun Dosen')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-akun-dosen')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection
