<?php


namespace App\Providers;


use App\Http\TestApiUser;
use Illuminate\Contracts\Auth\Authenticatable;

class TestUserProvider implements \Illuminate\Contracts\Auth\UserProvider
{
    protected function getUser()
    {
        return new TestApiUser(config('test.api_user.login'), config('test.api_user.password'));
    }

    public function retrieveById($identifier)
    {
        if ($identifier == config('test.api_user.login')) {
            return $this->getUser();
        }

        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (config('test.api_user.login') == @ $credentials['login'] && config('test.api_user.password') == @ $credentials['password']) {
            return $this->getUser();
        }

        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->getAuthIdentifier() == @ $credentials['login'] && $user->getAuthPassword() == @ $credentials['password'];
    }
}