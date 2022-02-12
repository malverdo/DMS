<?php

namespace App\Infrastructure\Entity;

use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractEntity;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Accessor;


class ProviderEntity extends AbstractEntity implements ProviderEntityInterface
{

    /**
     * @SerializedName("id")
     * @Type("int")
     * @var int
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
     * @Type("array")
     * @var array
     */
    protected $sender = [];

    /**
     * @SerializedName("password_md5")
     * @Type("bool")
     * @var bool
     */
    protected $passwordMd5;

    /**
     * @SerializedName("adapter_url")
     * @Type("string")
     * @var string
     */
    protected $adapterUrl;

    /**
     * @SerializedName("adapter_debug")
     * @Type("bool")
     * @var bool
     */
    protected $adapterDebug;

    /**
     * @SerializedName("adapter")
     * @Type("string")
     * @Accessor(setter="buildAdapter")
     * @var string
     */
    protected $adapter;

    /**
     * @var \stdClass
     */
    protected $adapterInstance;

    /**
     * @return string
     */
    public function getAdapterUrl(): string
    {
        return $this->adapterUrl;
    }

    /**
     * @param string $adapterUrl
     * @return ProviderEntity
     */
    public function setAdapterUrl(string $adapterUrl): ProviderEntity
    {
        $this->adapterUrl = $adapterUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdapterDebug(): bool
    {
        return $this->adapterDebug;
    }

    /**
     * @param bool $adapterDebug
     * @return ProviderEntity
     */
    public function setAdapterDebug(bool $adapterDebug): ProviderEntity
    {
        $this->adapterDebug = $adapterDebug;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    public function buildAdapter(string $adapter)
    {

        $this->adapter = $adapter;

        $password = $this->passwordMd5===true ? md5($this->password) : $this->password;

        $adapter = new $adapter($this->login, $password);

        if (isset($this->adapterUrl)) {
            $adapter->url = $this->adapterUrl;
        }

        if ($this->adapterDebug === true) {
            $adapter->debug = $this->adapterDebug;
        }

        $this->adapterInstance = $adapter;
    }

    /**
     * @todo повесить на интерфейс
     * @return mixed
     */
    public function getAdapterInstance()
    {
        return $this->adapterInstance;
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
     * @return bool
     */
    public function isPasswordMd5(): bool
    {
        return $this->passwordMd5;
    }

    /**
     * @param bool $passwordMd5
     * @return ProviderEntity
     */
    public function setPasswordMd5(bool $passwordMd5): ProviderEntity
    {
        $this->passwordMd5 = $passwordMd5;
        return $this;
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
     * @param array $senders
     * @return ProviderEntity
     */
    public function setSender(array $senders): ProviderEntity
    {
        $this->sender = $senders;
        return $this;
    }


}