@extends('layouts.admin')


@section('title', 'Tambah User')
@section('heading', 'Tambah User')

@section('content')
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="field">
            <label for="name">Nama</label>
            <input id="name" name="name" value="{{ old('name') }}" maxlength="255" required>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="255" required>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" minlength="8" required>
            <p class="hint">Minimal 8 karakter bosku.</p>
        </div>

        <div class="field">
            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" required>
        </div>

        <div class="actions">
            <button type="submit">Simpan</button>
            <a class="button secondary" href="{{ route('admin.users.index') }}">Batal</a>
        </div>
    </form>
@endsection
