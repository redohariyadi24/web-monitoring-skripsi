@extends('layout.layout-admin')

@section('title', 'Akun Admin')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        @livewire('tabel-akun-admin')
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection
