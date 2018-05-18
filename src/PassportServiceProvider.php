<?php

namespace YiluTech\Passport;

use DateInterval;
use Illuminate\Auth\RequestGuard;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Guards\TokenGuard;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\ResourceServer;
use Illuminate\Config\Repository as Config;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\ImplicitGrant;
use League\OAuth2\Server\Grant\PasswordGrant;
use Laravel\Passport\Bridge\PersonalAccessGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use Laravel\Passport\PassportServiceProvider as basePassportServiceProvider;

class PassportServiceProvider extends basePassportServiceProvider
{

}
