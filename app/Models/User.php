<?php

namespace App\Models;

use Sakuci\Database\Model;
use Sakuci\Session;

class User extends Model
{
    public static ?string $table = 'users';
    
    protected string $primaryKey = 'id';

    protected array $fillable = ['username', 'password', 'role'];
    protected array $hidden = ['password'];

    public static function find(mixed $id): ?static
    {
        return static::query()->where('id', '=', $id)->first();
    }

    public static function current(): ?self
    {
        $userId = Session::get('user_id') ?? Session::get('id');

        if (!$userId) {
            return null;
        }

        return static::find($userId);
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }
}