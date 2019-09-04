<?php declare(strict_types=1);


namespace App\Model\Logic;


use App\Bean\AuthManger;
use Swoft\Bean\Annotation\Mapping\Bean;
use App\Bean\AuthSession;

/**
 * Class AuthManagerLogic
 * @Bean()
 */
class AuthManagerLogic extends AuthManger
{
    /**
     * @var bool 开启缓存
     */
    protected $cacheEnable = true;

    public function adminBasicLogin(string $identity, string $credential): AuthSession
    {
        return $this->login(AccountLogic::class, [
            'identity'   => $identity,
            'credential' => $credential
        ]);
    }
}