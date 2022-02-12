<?php

namespace App\Infrastructure\Repository\Provider;

use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Domain\Provider\Contracts\ProviderRepositoryInterface;
use App\Infrastructure\Entity\ProviderEntity;
use App\Infrastructure\Repository\BaseRepository\Contracts\CollectionInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class ArrayProviderRepository implements ProviderRepositoryInterface
{

    //use ProviderBuilderTrait;

    private $data = [
        [
            'customer_ids' => [5, 9],
            'login' => 'cardsmile_2',
            'password' => 'QX9KbA7M',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'LEGO_stores'
        ],
        [
            'customer_ids' => [6],
            'login' => 'cardsmile_5',
            'password' => 'wef75brt',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'kid-rocks'
        ],
        [
            'customer_ids' => [7, 10],
            'login' => 'cardsmile_1',
            'password' => 'kjd63ter',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'Samsung'
        ],
        [
            'customer_ids' => [11],
            'login' => 'cardsmile_3',
            'password' => 'kjn94spr',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'Sony_Centre'
        ],
        [
            'customer_ids' => [4, 28],
            'login' => 'cardsmile_3',
            'password' => 'kjn94spr',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'reStore'
        ],
        [
            'customer_ids' => [14],
            'login' => 'cardsmile_4',
            'password' => 'upz46khy',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'STREET-BEAT'
        ],
        [
            'customer_ids' => [30],
            'login' => 'cardsmile_4',
            'password' => 'upz46khy',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'ROOKIE'
        ],
        [
            'customer_ids' => [17, 27],
            'login' => 'cardsmile_5',
            'password' => 'wef75brt',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'Nike_stores'
        ],
        [
            'customer_ids' => [18, 26],
            'login' => 'Cardsmile_2.2',
            'password' => 'VAnAt9My',
            'adapter' => 'SmscGateway',
            'sender' => 'UNOde50'
        ],
        [
            'customer_ids' => [31],
            'login' => 'Tehnosila_dev',
            'password' => 'dsm49rua',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'Tehnosila'
        ],
        [
            'customer_ids' => [32],
            'login' => 'rightway1',
            'password' => 'psHh9pbo',
            'adapter' => 'EasySMSGateway',
            'sender' => 'INCITY'
        ],
        [
            'customer_ids' => [33],
            'login' => 'dms',
            'password' => 'eblouptoga',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'DMS'
        ],
        [
            'customer_ids' => [34],
            'login' => 'cardsmile_4',
            'password' => 'upz46khy',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'LEAP'
        ],
        [
            'customer_ids' => [35],
            'login' => 'market-standart',
            'password' => 'wkp48znb',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'STANDART'
        ],
        [
            'customer_ids' => [36],
            'login' => 'edisonrussvet',
            'password' => 'Edisonrussvet1',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'EDISON'
        ],
        [
            'customer_ids' => [37],
            'login' => 'cardsmile_6',
            'password' => 'aln36pej',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'MISIA'
        ],
        [
            'customer_ids' => [38],
            'login' => 'ZASPORT',
            'password' => 'Zasportsms1',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'ZASPORT'
        ],
        [
            'customer_ids' => [39],
            'login' => 'vizhuvse',
            'password' => 'Optica',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'Vizhuvse'
        ],
        [
            'customer_ids' => [40],
            'login' => 'vizhuvse',
            'password' => 'Optica',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => "Ochkov's"
        ],
        [
            'customer_ids' => [41],
            'login' => 'Samsonite',
            'password' => '9nnsfogr',
            'adapter' => 'EasySMSGateway',
            'adapter_url' => 'https://xml.smstec.ru/requests/checkdm_sendsms',
            'sender' => "SAMSONITE"
        ],
        [
            'customer_ids' => [42],
            'login' => 'clubsota.ru',
            'password' => 'clubsota2018',
            'adapter' => 'SmscGateway',
            'sender' => "clubsota.ru"
        ],
        [
            'customer_ids' => [2],
            'login' => 'happylookM_CRML',
            'password' => 'df211729-6b52-4710-9f5d-086475d77594',
            'adapter' => 'ImobisGateway',
            'adapter_debug' => true,
            'sender' => "HAPPYLOOK"
        ],
        [
            'customer_ids' => [44],
            'login' => 'Galaxymart',
            'password' => '391860',
            'adapter' => 'SmscGateway',
            'sender' => "online-sams"
        ],
        [
            'customer_ids' => [45],
            'login' => 'farm',
            'password' => 'UjsyM3Ag',
            'adapter' => 'EasySMSGateway',
            'sender' => 'SOCIALOCHKA'
        ],
        [
            'customer_ids' => [47],
            'login' => 'city-pets.ru',
            'password' => 'Gy0QKILL',
            'adapter' => 'EasySMSGateway',
            'sender' => 'Petcity'
        ],
        [
            'customer_ids' => [48],
            'login' => 'breadstories',
            'password' => 'bestbread!!',
            'adapter' => 'SmscGateway',
            'sender' => 'BREADSTORY'
        ],
        [
            'customer_ids' => [49],
            'login' => 'GC_SOLAR',
            'password' => 'qwerty2018!LITRA',
            'adapter' => 'SmscGateway',
            'sender' => 'NAPITKI.RA'
        ],
        [
            'customer_ids' => [50],
            'login' => 'dms',
            'password' => 'eblouptoga',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'K.PROFI'
        ],
        [
            'customer_ids' => [51],
            'login' => 'muztorg',
            'password' => 'muztorg19092018',
            'adapter' => 'SmscGateway',
            'sender' => 'MUZTORG'
        ],
        [
            'customer_ids' => [52],
            'login' => 'cardsmile_7',
            'password' => 'b39cdkq1',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'HuaweiStore'
        ],
        [
            'customer_ids' => [53],
            'login' => 'crm_omni',
            'password' => 'jx0f+j-w%f',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'Lensmaster'
        ],
        [
            'customer_ids' => [54],
            'login' => 'lanit-tokyo-city',
            'password' => 'WFEWF@3455#$&^*sdf',
            'password_md5' => true,
            'adapter' => 'SmscGateway',
            'sender' => 'TOKIO-CITY'
        ],
        [
            'customer_ids' => [55],
            'login' => 'sinar',
            'password' => '7a9wZG7kV',
            'adapter' => 'SmscGateway',
            'sender' => 'Sinar'
        ],
        [
            'customer_ids' => [56],
            'login' => 'quiksilver_54',
            'password' => 'BdCVHFHm49oL4y',
            'adapter' => 'SmscGateway',
            'sender' => 'Quiksilver'
        ],
        [
            'customer_ids' => [57],
            'login' => 'overkill_54',
            'password' => 'J9wF8BpHDGz7Py',
            'adapter' => 'SmscGateway',
            'sender' => 'Overkill'
        ],
        [
            'customer_ids' => [58],
            'login' => 'TUMI',
            'password' => 'MfEgUBNJ',
            'adapter' => 'EasySMSGateway',
            'sender' => 'TUMI'
        ],
        [
            'customer_ids' => [59],
            'login' => 'ntvplussd2',
            'password' => '2gedJAmb9K',
            'adapter' => 'SMSTrafficGateway',
            'adapter_url' => 'https://ntvplus.smstraffic.ru/sys/send.php'
        ],
        [
            'customer_ids' => [60],
            'login' => 'bahetle_rightway',
            'password' => 'upPT6Q3Ub',
            'adapter' => 'SmscGateway',
            'sender' => 'Bahetle'
        ],
        [
            'customer_ids' => [61],
            'login' => 'deichmann',
            'password' => 'pykh7sbi',
            'adapter' => 'EasySMSGateway',
            'sender' => 'DEICHMANN'
        ],
        [
            'customer_ids' => [62],
            'login' => 'asna',
            'password' => 'cf7Y3fs9',
            'adapter' => 'EasySMSGateway',
            'sender' => 'ASNAPLUS'
        ],
        [
            'customer_ids' => [63],
            'login' => 'lanit-cristal',
            'password' => '7793ebb76ea6454598434778c717b5ff',
            'adapter' => 'SmscGateway'
        ],
        [
            'customer_ids' => [65],
            'login' => 'Cardsmile_4.2',
            'password' => '0f340440bcb84d1da636cdcdc139d8ba',
            'adapter' => 'SmscGateway',
            'sender' => 'TNF_stores'
        ],
        [
            'customer_ids' => [66],
            'login' => 'happylookM_CRML',
            'password' => 'df211729-6b52-4710-9f5d-086475d77594',
            'adapter' => 'ImobisGateway',
            'sender' => 'HAPPYLOOK'
        ],
        [
            'customer_ids' => [67],
            'login' => 'bergauf',
            'password' => 'C-cYZZ.49Y',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'Bergauf'
        ],
        [
            'customer_ids' => [68],
            'login' => 'lanit-TokyoMarket',
            'password' => 'dw3s68dK4Y',
            'adapter' => 'SmscGateway',
            'sender' => 'TokyoMarket'
        ],
        [
            'customer_ids' => [69],
            'login' => 'cardsmile_9',
            'password' => 'dw3s68dK4Y',
            'adapter' => 'SmscGateway',
            'sender' => 'ESCHE'
        ],
        [
            'customer_ids' => [70],
            'login' => 'Cardsmile_10',
            'password' => 'ha81ncb4',
            'adapter' => 'SmscGateway',
            'sender' => 'Mi Stores'
        ],
        [
            'customer_ids' => [71],
            'login' => 'zolla_rek',
            'password' => 'aWtfbFaP',
            'adapter' => 'EasySMSGateway',
            'sender' => 'Zolla'
        ],
        [
            'customer_ids' => [72],
            'login' => 'novex_trade',
            'password' => 'Новэкс2016',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'Novex'
        ],
        [
            'customer_ids' => [73],
            'login' => 'kinoformat_sms',
            'password' => 'y4Tkuh3v1',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'KINOFORMAT'
        ],
        [
            'customer_ids' => [74],
            'login' => 'lanmarket',
            'password' => 'fpu9J4Cy',
            'adapter' => 'EasySMSGateway',
            'sender' => 'X-Fit'
        ],
        [
            'customer_ids' => [75],
            'login' => 'Kinomax',
            'password' => 'Aq1-Sw2-De3',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'KINOMAX'
        ],
        [
            'customer_ids' => [76],
            'login' => 'Vremena_goda',
            'password' => 'VGmarketing2020!',
            'adapter' => 'DevinoSMSGateway',
            'sender' => 'VremenaGoda'
        ],
        [
            'customer_ids' => [77],
            'login' => 'ns258562',
            'password' => '57a3a4f4-b980-4b11-9c65-b97569c84df7',
            'adapter' => 'ImobisGateway',
            'sender' => 'PEPLOS'
        ],
        [
            'customer_ids' => [78],
            'login' => 'GLENFIELD',
            'password' => 'xKgvYqfw',
            'adapter' => 'EasySMSGateway',
            'sender' => 'GLENFIELD'
        ],
        [
            'customer_ids' => [79],
            'login' => 'cardsmile_7',
            'password' => 'b39cdkq1',
            'adapter' => 'SmscGateway',
            'sender' => 're.new'
        ],
        [
            'customer_ids' => [81],
            'login' => 'b-apteka',
            'password' => 'Gei7agi6',
            'adapter' => 'SmscGateway',
            'sender' => 'FARMABONUS'
        ],
        [
            'customer_ids' => [82],
            'login' => 'GLENFIELD',
            'password' => 'xKgvYqfw',
            'adapter' => 'EasySMSGateway',
            'sender' => 'GLENFIELD'
        ],
        [
            'customer_ids' => [83],
            'login' => 'lanit-bahroma',
            'password' => "IJNdfgh64BH!de9",
            'adapter' => 'SmscGateway',
            'sender' => 'BAHROMA'
        ],
        [
            'customer_ids' => [84],
            'login' => 'ecco-sinar',
            'password' => "Sinarecco12345867",
            'adapter' => 'SmscGateway',
            'sender' => 'ECCO'
        ],
        [
            'customer_ids' => [85],
            'login' => 'cinemaobninsk',
            'password' => "kino2018",
            'adapter' => 'SmscGateway',
            'sender' => 'CINEMADELUX'
        ],
    ];

    private const DEFAULT_SENDER_NAME = 'CardSmile';

    private $default = [
        'login' => 'dms',
        'password' => 'eblouptoga',
        'password_md5' => true,
        'adapter' => 'SmscGateway',
        'sender' => self::DEFAULT_SENDER_NAME
    ];

    //Отправители редактируются тут для пользователей
    private $senders = [
        81 => ['b-apteka']
    ];

    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function getCriteria(): RepositoryCriteriaInterface
    {
        return ProviderCriteria::create();
    }

    public function getModel(): EntityInterface
    {
        return new ProviderEntity();
    }

    public function countByCriteria(RepositoryCriteriaInterface $criteria): int
    {
        // TODO: Implement countByCriteria() method.
    }

    public function findById(string $id): ?EntityInterface
    {
        // TODO: Implement findById() method.
    }

    public function save(EntityInterface $entity): void
    {
        // TODO: Implement save() method.
    }

    public function delete(EntityInterface $entity): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return CollectionInterface
     */
    public function findByCriteria(RepositoryCriteriaInterface $criteria): CollectionInterface
    {
        $rows = [];
        $i = 1;

        $customerId = (int)$criteria->getFilterByCustomerId();

        foreach ($this->data as $key => $data) {
            $data['id'] = $i;
            $data['customer_id'] = $customerId;

            $i++;
            if (!in_array($customerId, $data['customer_ids'], true)) {
                continue;
            }
            $rows[] = $data;
        }

        if (!count($rows)) {
            $row = $this->default;
            $row['customer_id'] = $customerId;
            $rows[] = $row;
        }

        //заменяем senders
        foreach ($rows as $i => $row) {
            $senderName = isset($row['sender']) ? $row['sender'] : self::DEFAULT_SENDER_NAME;
            if ((int)$row['customer_id'] === $customerId &&
                isset($this->senders[$customerId])) {
                $rows[$i]['sender'] = array_merge($this->senders[$customerId], [$senderName]);
            } else {
                $rows[$i]['sender'] = [$senderName];
            }
        }

        return new ProviderCollection($this->deserialize($rows, ProviderEntity::class));
    }

    /**
     * @param array $results
     * @param string $className
     * @return array
     */
    protected function deserialize(array $results, string $className): array
    {
        return $this->serializer->deserialize(json_encode($results), 'array<' . $className . '>', 'json');
    }

}