<?php

namespace YiluTech\Passport\Bridge;

use Laravel\Passport\Bridge\AccessTokenRepository as BaseAccessTokenRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class AccessTokenRepository extends BaseAccessTokenRepository
{

    /**
     * {@inheritdoc}
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessToken($userIdentifier, $scopes);
    }


}
