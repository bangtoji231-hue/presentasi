# Catatan Presentasi: CRUD User

## Pembagian area

- Admin login melalui halaman yang sama dengan user, tetapi diarahkan ke dashboard admin.
- Admin dapat melihat, menambah, mengubah, dan menghapus akun melalui area `/admin`.
- User biasa diarahkan ke dashboard user dan tidak dapat membuka route admin.
- Pemeriksaan akses dilakukan oleh Gate `manage-users` dan `access-user-area` di `app/Providers/AppServiceProvider.php`.

## Urutan alur CRUD

1. `routes/web.php` menerima URL dan meneruskannya ke controller yang tepat.
2. Middleware `auth` memastikan pengunjung sudah login. Middleware Gate membedakan akses admin dan user biasa.
3. `app/Http/Controllers/Admin/UserController.php` menjalankan logika CRUD dan validasi.
4. View Blade di `resources/views/admin/users/` menampilkan daftar, formulir tambah, formulir edit, dan detail secara terpisah.
5. `app/Models/User.php` menghubungkan aplikasi dengan tabel `users`; password otomatis di-hash.
6. Migration di `database/migrations/` menyiapkan struktur tabel. Migration tidak dijalankan setiap kali user menyimpan form.

## Method controller

| Method | Fungsi |
|---|---|
| `index()` | Mengambil daftar user, mengurutkan berdasarkan nama, dan membaginya menjadi halaman. |
| `create()` | Menampilkan form kosong dari `admin/users/create.blade.php`. |
| `store()` | Memvalidasi lalu menyimpan user baru. |
| `show()` | Menampilkan detail user dari `admin/users/show.blade.php`. |
| `edit()` | Menampilkan form berisi data user dari `admin/users/edit.blade.php`. |
| `update()` | Memvalidasi dan menyimpan perubahan user. |
| `destroy()` | Memastikan admin tidak menghapus akunnya sendiri atau admin terakhir, lalu menghapus user. |

## File inti untuk dipresentasikan

1. `routes/web.php` — pembagian route dashboard admin/user dan route CRUD admin.
2. `app/Providers/AppServiceProvider.php` — aturan Gate untuk memisahkan izin admin dan user.
3. `app/Http/Controllers/Admin/UserController.php` — proses CRUD, validasi, dan perlindungan penghapusan.
4. `resources/views/admin/users/index.blade.php` — daftar user dan tombol aksi.
5. `resources/views/admin/users/create.blade.php` — formulir tambah.
6. `resources/views/admin/users/edit.blade.php` — formulir edit.
7. `resources/views/admin/users/show.blade.php` — detail satu user.
8. `resources/views/user/dashboard.blade.php` — halaman dashboard user biasa.
9. `app/Models/User.php` dan migration tabel `users` — hubungan model dengan struktur database.

## Contoh alur tambah user

Admin membuka `admin.users.create` → route memanggil `create()` → view `create.blade.php` menampilkan form → form mengirim data ke `admin.users.store` → `store()` memvalidasi → `User::create()` menyimpan data melalui model ke tabel `users` → admin kembali ke daftar user.

## Validasi dan keamanan

- Nama dan email wajib diisi; email harus valid dan tidak boleh duplikat.
- Password saat membuat user wajib diisi, minimal 8 karakter, dan harus dikonfirmasi.
- Saat edit, password boleh dikosongkan agar password yang lama tetap digunakan.
- Password di-hash oleh cast `hashed` di model.
- Form memakai CSRF token.
- Hanya admin yang dapat mengakses route CRUD.
- Admin tidak dapat menghapus akun yang sedang digunakan maupun admin terakhir.

## Menyiapkan admin pertama

Setelah menjalankan `php artisan migrate`, jalankan:

```bash
php artisan users:make-admin email@contoh.com
```

Command `app/Console/Commands/MakeUserAdmin.php` dapat mengangkat akun yang sudah terdaftar atau membuat admin pertama.

pembuatan admin
#php artisan users:make-admin email@contoh.com
