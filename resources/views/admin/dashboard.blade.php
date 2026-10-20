@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('heading', 'Dashboard Admin')

@section('content')
    <p>Selamat datang, {{ auth()->user()->name }}.</p>
    <p style="margin-top: 16px;">
        <a class="button" href="{{ route('admin.users.index') }}">Kelola User</a>
    </p>
    <form method="POST" action="{{ route('logout') }}" style="margin-top: 16px;">
        @csrf
        <button class="button secondary" type="submit">Logout</button>
    </form>
@endsection
