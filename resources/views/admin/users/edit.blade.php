@extends('layouts.admin')

@section('title', 'Edit User')
@section('heading', 'Edit User')

@section('content')
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="name">Nama</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" maxlength="255" required>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" maxlength="255" required>
        </div>

        <div class="field">
            <label for="password">Password (kosongkan jika tidak diubah)</label>
            <input id="password" name="password" type="password" minlength="8">
            <p class="hint">Minimal 8 karakter jika ingin mengganti password.</p>
        </div>

        <div class="field">
            <label for="password_confirmation">Konfirmasi password baru</label>
            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8">
        </div>

        <div class="actions">
            <button type="submit">Simpan perubahan</button>
            <a class="button secondary" href="{{ route('admin.users.index') }}">Batal</a>
        </div>
    </form>
@endsection
