<?php

namespace App\Infrastructure\Exception;

class InvalidRequestException  extends  \Exception
{
    const MESSAGE = 'В запросе к процессингу обнаружена ошибка или неверный вид XML';

    /**
     * @var string
     */
    private $msg;

    /**
     * InvalidRequestException constructor.
     * @param string $msg
     * @param \Exception|null $previous
     */
    public function __construct($msg = '', \Exception $previous = null)
    {
        $this->msg = $msg;
        parent::__construct(
            $this->getErrorMessage(),
            $this->getErrorCode(),
            $previous
        );
    }


    /**
     * Возвращает код ошибки
     *
     * @return integer
     */
    protected function getErrorCode()
    {
        return E_USER_NOTICE;
    }

    /**
     * Возвращает сообщение об ошибке
     *
     * @return string
     */
    protected function getErrorMessage()
    {
        return (strlen($this->msg) > 0)
            ? self::MESSAGE . ': ' . $this->msg
            : self::MESSAGE;
    }
}