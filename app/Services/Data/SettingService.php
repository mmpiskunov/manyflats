<?php

namespace App\Services\Data;

class SettingService
{
    const PROJECTS = ['manyflats.com' => 'ManyFlats.com'];

    const COUNTRIES = [
        'estonia'   => ['tallinn', 'tartu'],
        'latvia'    => ['riga', 'jurmala'],
        'lithuania' => ['vilnius', 'kaunas', 'klaipeda'],
        'germany'   => ['berlin', 'hamburg', 'muenchen', 'cologne', 'frankfurt', 'stuttgart', 'dusseldorf', 'dortmund', 'essen', 'leipzig', 'bremen', 'dresden', 'hanover', 'nuremberg', 'duisburg', 'bochum', 'wuppertal', 'bielefeld', 'bonn', 'munster', 'karlsruhe', 'mannheim']
    ];

    const CITIES = ['riga', 'jurmala', 'tallinn', 'tartu', 'vilnius', 'kaunas', 'klaipeda', 'berlin', 'hamburg', 'muenchen', 'cologne', 'frankfurt', 'stuttgart', 'dusseldorf', 'dortmund', 'essen', 'leipzig', 'bremen', 'dresden', 'hanover', 'nuremberg', 'duisburg', 'bochum', 'wuppertal', 'bielefeld', 'bonn', 'munster', 'karlsruhe', 'mannheim'];

    const TRANSLATE_CITIES =
        [
            'en' =>
                [
                    'riga'       => 'Riga',
                    'jurmala'    => 'Yurmala',
                    'tallinn'    => 'Tallinn',
                    'tartu'      => 'Tartu',
                    'vilnius'    => 'Vilnius',
                    'kaunas'     => 'Kaunas',
                    'klaipeda'   => 'Klaipeda',
                    'berlin'     => 'Berlin',
                    'hamburg'    => 'Hamburg',
                    'muenchen'   => 'Munich',
                    'cologne'    => 'Cologne',
                    'frankfurt'  => 'Frankfurt',
                    'stuttgart'  => 'Stuttgart',
                    'dusseldorf' => 'Dusseldorf',
                    'dortmund'   => 'Dortmund',
                    'essen'      => 'Essen',
                    'leipzig'    => 'Leipzig',
                    'bremen'     => 'Bremen',
                    'dresden'    => 'Dresden',
                    'hanover'    => 'Hanover',
                    'nuremberg'  => 'Nuremberg',
                    'duisburg'   => 'Duisburg',
                    'bochum'     => 'Bochum',
                    'wuppertal'  => 'Wuppertal',
                    'bielefeld'  => 'Bielefeld',
                    'bonn'       => 'Bonn',
                    'munster'    => 'Munster',
                    'karlsruhe'  => 'Karlsruhe',
                    'mannheim'   => 'Mannheim',
                ],

            'ru' =>
                [
                    'riga'       => 'Рига',
                    'jurmala'    => 'Юрмала',
                    'tallinn'    => 'Таллин',
                    'tartu'      => 'Тарту',
                    'vilnius'    => 'Вильнюс',
                    'kaunas'     => 'Каунас',
                    'klaipeda'   => 'Клайпеда',
                    'berlin'     => 'Берлин',
                    'hamburg'    => 'Гамбург',
                    'muenchen'   => 'Мюнхен',
                    'cologne'    => 'Кёльн',
                    'frankfurt'  => 'Франкфурт',
                    'stuttgart'  => 'Штутгарт',
                    'dusseldorf' => 'Дюссельдорф',
                    'dortmund'   => 'Дортмунд',
                    'essen'      => 'Эссен',
                    'leipzig'    => 'Лейпциг',
                    'bremen'     => 'Бремен',
                    'dresden'    => 'Дрезден',
                    'hanover'    => 'Ганновер',
                    'nuremberg'  => 'Нюрнберг',
                    'duisburg'   => 'Дуйсбург',
                    'bochum'     => 'Бохум',
                    'wuppertal'  => 'Вупперталь',
                    'bielefeld'  => 'Билефельд',
                    'bonn'       => 'Бонн',
                    'munster'    => 'Мюнстер',
                    'karlsruhe'  => 'Карлсруэ',
                    'mannheim'   => 'Маннгейм',
                ]
        ];

    const PER_YEAR =
        [
            'en' => 'per annum',
            'lv' => 'gadā',
            'ru' => 'годовых',
        ];

    const PAYBACK =
        [
            'en' => 'payback',
            'lv' => 'atmaksāšanās',
            'ru' => 'окупаемости',
        ];

    const DESIGN =
        [
            'default' => 'design/old_city.jpg',
            'vecriga' => 'design/old_city.jpg'
        ];

    /**
     * @return array
     */
    public static function getCountries(): array
    {
        return array_keys(self::COUNTRIES);
    }
}
