@extends('layout.layout-admin')

@section('title', 'Akun Mahasiswa')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-akun-mahasiswa')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection
