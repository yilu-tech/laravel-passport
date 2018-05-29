<?php

namespace YiluTech\Passport;


use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\PassportServiceProvider as basePassportServiceProvider;

class PassportServiceProvider extends basePassportServiceProvider
{
    public function makeAuthorizationServer()
    {
        return new AuthorizationServer(
            $this->app->make(\Laravel\Passport\Bridge\ClientRepository::class),
            $this->app->make(Bridge\AccessTokenRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey()
        );
    }
}
