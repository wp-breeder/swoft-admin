<?php declare(strict_types=1);


namespace App\Bean;

use ReflectionException as ReflectionExceptionAlias;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Concern\PrototypeTrait;
use Swoft\Bean\Exception\ContainerException as ContainerExceptionAlias;

/**
 * Class AuthResult
 * @Bean(scope=Bean::PROTOTYPE)
 */
class AuthResult
{
    use PrototypeTrait;

    /**
     * @var string
     */
    protected $identity = '';
    /**
     * @var array
     */
    protected $extendedData = [];

    public function getIdentity(): string
    {
        return $this->identity;
    }
    public function setIdentity(string $identity): self
    {
        $this->identity = $identity;
        return $this;
    }
    public function getExtendedData(): array
    {
        return $this->extendedData;
    }
    public function setExtendedData(array $extendedData): self
    {
        $this->extendedData = $extendedData;
        return $this;
    }

    /**
     * Create a new AuthSession.
     * @param array $items
     * @return AuthResult
     * @throws ReflectionExceptionAlias
     * @throws ContainerExceptionAlias
     */
    public static function new(array $items = []): self
    {
        $self        = self::__instance();
        return $self;
    }
}