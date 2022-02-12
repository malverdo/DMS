<?php

namespace App\Infrastructure\Repository\Provider;

use App\Infrastructure\Entity\ProviderEntity;
use App\Infrastructure\Entity\Sender;

trait ProviderBuilderTrait
{
    /**
     * @param $key
     * @param $data
     * @return ProviderEntity
     */
    private function buildEntity($key, $data)
    {

        if (empty($data['login']) || empty($data['password']) || empty($data['adapter'])) {
            throw new \RuntimeException('provider data incorrect');
        }

        $password = isset($data['password_md5']) ? md5($data['password']) : $data['password'];

        $adapter = new $data['adapter']($data['login'], $password);

        $senders = [];

        if (!empty($data['senders'])) {
            $sendersAr = explode(',', $data['senders']);
            foreach ($sendersAr as $sender) {
                $senders[] = new Sender($sender);
            }
        }

        if (isset($data['adapter_url'])) {
            $adapter->url = $data['adapter_url'];
        }

        if (isset($data['adapter_debug'])) {
            $adapter->debug = (bool)$data['adapter_debug'];
        }

        return new ProviderEntity(
            $key,
            $data['login'],
            $password,
            $adapter,
            $senders
        );
    }
}