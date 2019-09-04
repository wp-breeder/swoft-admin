<?php declare(strict_types=1);


namespace App\Contract;


use App\Bean\AuthResult;

interface AccountTypeInterface
{
    const LOGIN_IDENTITY = 'identity';
    const LOGIN_CREDENTIAL = 'credential';

    public function login(array $data): AuthResult;

    public function authenticate(string $identity): bool;
}