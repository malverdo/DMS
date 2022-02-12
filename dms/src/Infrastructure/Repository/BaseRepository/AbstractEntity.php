<?php

namespace App\Infrastructure\Repository\BaseRepository;

use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use JMS\Serializer\Annotation;

/**
 * Class AbstractEntity
 * @package App\Infrastructure\Repository\BaseRepository
 */
abstract class AbstractEntity implements EntityInterface
{

    /**
     * @var string|int|null
     */
    protected $id;

    /**
     * @Annotation\Exclude
     * @var bool
     */
    protected $new = false;

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->new;
    }



    public function getId()
    {
        return $this->id;
    }

    public function __construct(){
        $this->new = true;
    }


    /**
     * @param bool $new
     * @return $this
     */
    public function setNew(bool $new): AbstractEntity
    {
        $this->new = $new;
        return $this;
    }


    /**
     * Return an associative array containing all the properties in this object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return string
     */
    public function toJson(): string
    {

        return json_encode($this->toArray());
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
        return parent::__get($name);
    }

    public function __isset($name){
        $method = 'get' . $name;
        if (method_exists($this, $method)){
            return true;
        }
        return isset($this->$name);
    }

    /**
     * @return mixed
     */
    public function getPrimaryKey()
    {
        return $this->id;
    }

    /**
     * @param int|string|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

}