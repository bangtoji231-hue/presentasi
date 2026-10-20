@extends('layouts.admin')

@section('title', 'Daftar User')
@section('heading', 'Kelola User')

@section('content')
    <p><a class="button" href="{{ route('admin.users.create') }}">+ Tambah user</a></p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis akun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                    <td>
                        <div class="actions">
                            <a class="button small secondary" href="{{ route('admin.users.show', $user) }}">Detail</a>
                            <a class="button small secondary" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                onsubmit="return confirm('Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button class="danger small" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada user.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">{{ $users->links() }}</div>
@endsection
