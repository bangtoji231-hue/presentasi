@extends('layouts.admin')

@section('title', 'Detail User')
@section('heading', 'Detail User')

@section('content')
    <table>
        <tbody>
            <tr><th>ID</th><td>{{ $user->id }}</td></tr>
            <tr><th>Nama</th><td>{{ $user->name }}</td></tr>
            <tr><th>Email</th><td>{{ $user->email }}</td></tr>
            <tr><th>Jenis akun</th><td>{{ $user->is_admin ? 'Admin' : 'User' }}</td></tr>
            <tr><th>Bergabung</th><td>{{ $user->created_at->format('d M Y H:i') }}</td></tr>
        </tbody>
    </table>

    <p class="actions" style="margin-top: 20px;">
        <a class="button" href="{{ route('admin.users.edit', $user) }}">Edit user</a>
        <a class="button secondary" href="{{ route('admin.users.index') }}">Kembali</a>
    </p>
@endsection
