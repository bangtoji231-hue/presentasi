<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_users_cannot_manage_users(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertForbidden();

        $this->get(route('admin.dashboard'))->assertForbidden();
        $this->get(route('user.dashboard'))->assertOk();
    }

    public function test_login_redirects_admin_and_regular_users_to_separate_dashboards(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $this->post(route('login'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->post(route('logout'))->assertRedirect('/login');

        $user = User::factory()->create([
            'email' => 'user@example.com',
            'is_admin' => false,
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('user.dashboard'));
    }

    public function test_admin_can_create_view_update_and_delete_users(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $this->get(route('admin.dashboard'))->assertOk();
        $this->get(route('user.dashboard'))->assertForbidden();
        $this->get(route('admin.users.index'))->assertOk();
        $this->get(route('admin.users.create'))->assertOk()->assertViewIs('admin.users.create');

        $this->post(route('admin.users.store'), [
            'name' => 'Siswa Contoh',
            'email' => 'siswa@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'siswa@example.com')->firstOrFail();
        $this->assertTrue(password_verify('password123', $user->password));
        $this->get(route('admin.users.edit', $user))->assertOk()->assertViewIs('admin.users.edit');

        $this->get(route('admin.users.show', $user))->assertOk()->assertSee('Siswa Contoh');

        $this->put(route('admin.users.update', $user), [
            'name' => 'Siswa Diperbarui',
            'email' => 'siswa@example.com',
            'password' => '',
            'password_confirmation' => '',
        ])->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Siswa Diperbarui',
        ]);

        $this->delete(route('admin.users.destroy', $user))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_cannot_delete_their_own_account_or_the_last_admin(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $this->delete(route('admin.users.destroy', $admin))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', ['id' => $admin->id]);

        $otherAdmin = User::factory()->create(['is_admin' => true]);
        $otherAdmin->delete();

        $this->delete(route('admin.users.destroy', $admin))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_existing_user_can_be_promoted_to_admin_with_artisan_command(): void
    {
        $user = User::factory()->create();

        $this->artisan('users:make-admin', ['email' => $user->email])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_admin' => true,
        ]);
    }

    public function test_artisan_command_can_create_the_first_admin(): void
    {
        $this->artisan('users:make-admin', ['email' => 'admin@example.com'])
            ->expectsConfirmation('User belum ada. Buat akun admin baru?', 'yes')
            ->expectsQuestion('Nama admin', 'Admin Contoh')
            ->expectsQuestion('Password admin (minimal 8 karakter)', 'password123')
            ->expectsQuestion('Konfirmasi password', 'password123')
            ->assertSuccessful();

        $admin = User::where('email', 'admin@example.com')->firstOrFail();
        $this->assertTrue($admin->is_admin);
        $this->assertTrue(password_verify('password123', $admin->password));
    }
}
