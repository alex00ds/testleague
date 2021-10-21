<?php


namespace App\Http;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class TestApiUser implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;

    protected $password;
    protected $login;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Dumb method to comply Illuminate\Auth\Authenticatable
     *
     * @return mixed
     */
    public function getKeyName()
    {
        return 'login';
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->login;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}