<?php

namespace YiluTech\Passport\Bridge;

use Laravel\Passport\Bridge\AccessToken as BaseAccessToken;

use Lcobucci\JWT\Builder;
use League\OAuth2\Server\CryptKey;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Key;
class AccessToken extends BaseAccessToken
{
    /**
     * Generate a JWT from the access token
     *
     * @param CryptKey $privateKey
     *
     * @return Token
     */
    public function convertToJWT(CryptKey $privateKey)
    {
        return (new Builder())
            ->setAudience($this->getClient()->getIdentifier())
            ->setId($this->getIdentifier(), true)
            ->setIssuedAt(time())
            ->setNotBefore(time())
            ->setExpiration($this->getExpiryDateTime()->getTimestamp())
            ->setSubject($this->getUserIdentifier())
            ->set('scopes', $this->getScopes())
            ->set('authType', 'staff')
            ->sign(new Sha256(), new Key($privateKey->getKeyPath(), $privateKey->getPassPhrase()))
            ->getToken();
    }

}
