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
        $builder = new Builder();
        $builder->setAudience($this->getClient()->getIdentifier())
            ->setId($this->getIdentifier(), true)
            ->setIssuedAt(time())
            ->setNotBefore(time())
            ->setExpiration($this->getExpiryDateTime()->getTimestamp())
            ->setSubject($this->getUserIdentifier())
            ->set('scopes', $this->getScopes());

        if(config('auth.issuer')){
            $builder->setIssuer(config('auth.issuer'));
        }
        if(config('auth.payload')){
            foreach (config('auth.payload') as $key => $item){ //todo::目前直接闭包在配置文件，导致配置文件不能缓存，需要
                if(is_callable($item)){
                    $value = $item($this);
                }
                $builder->set($key,$value);
            }
        }

        return $builder->sign(new Sha256(), new Key($privateKey->getKeyPath(), $privateKey->getPassPhrase()))
            ->getToken();

    }

}
