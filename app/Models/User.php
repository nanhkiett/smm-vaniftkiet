<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

#[Fillable(['name', 'username', 'email', 'phone', 'password', 'balance', 'role', 'status', 'api_key_hashed', 'api_key_last_used_at', 'api_key_plain'])]
#[Hidden(['password', 'remember_token', 'api_key_hashed'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUlids;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'balance' => 'decimal:2',
        ];
    }

    /** Ký tự đầu tên — dùng avatar chữ trong UI (UTF-8). */
    public function nameInitial(): string
    {
        $name = trim((string) $this->name);

        if ($name === '') {
            return '?';
        }

        return mb_strtoupper(mb_substr($name, 0, 1, 'UTF-8'), 'UTF-8');
    }
}
