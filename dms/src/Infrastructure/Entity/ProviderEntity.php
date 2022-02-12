<?php

namespace App\Infrastructure\Entity;

use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Accessor;


class ProviderEntity extends AbstractEntity implements ProviderEntityInterface
{

    /**
     * @SerializedName("id")
     * @Type("int")
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @SerializedName("customer_id")
     * @Type("int")
     * @var int
     */
    protected $customerId;

    /**
     * @SerializedName("login")
     * @Type("string")
     * @var string
     */
    protected $login;

    /**
     * @SerializedName("password")
     * @Type("string")
     * @var string
     */
    protected $password;

    /**
     * @SerializedName("sender")
     * @Type("string")
     * @var string
     */
    protected $sender;

    /**
     * @SerializedName("adapter")
     * @Type("string")
     * @Accessor(setter="buildAdapter")
     * @var string
     */
    protected $adapter;


    public function buildAdapter(string $adapter)
    {
        $this->adapter = $adapter;
    }


    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return ProviderEntity
     */
    public function setCustomerId(int $customerId): ProviderEntity
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return ProviderEntity
     */
    public function setLogin(string $login): ProviderEntity
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return ProviderEntity
     */
    public function setPassword(string $password): ProviderEntity
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdapter(): string
    {
        return $this->adapter;
    }

    /**
     * @param string $adapter
     * @return ProviderEntity
     */
    public function setAdapter(string $adapter): ProviderEntity
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return array
     */
    public function getSender(): array
    {
        return $this->sender;
    }

    /**
     * @param string $senders
     * @return ProviderEntity
     */
    public function setSender(string $senders): ProviderEntity
    {
        $this->sender = $senders;
        return $this;
    }


    public function getAdapterInstance()
    {
        // TODO: Implement getAdapterInstance() method.
    }
}