<section class="sidebar">
    <?= dmstr\widgets\Menu::widget([
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'items'   => [
            [
                'icon'  => 'gift',
                'label' => 'Матчи',
                'url'   => ['/matches/default/index'],
            ],
            [
                'icon'  => 'dollar',
                'label' => 'Ставки',
                'url'   => ['/bets/default/index'],
            ],
            [
                'icon'  => 'cog',
                'label' => 'Настройки',
                'url'   => ['/config/default/index'],
                'items' => [
                    [
                        'icon'  => 'cog',
                        'label' => 'Настройки',
                        'url'   => ['/config/default/index'],
                    ],
                    [
                        'icon'  => 'plus',
                        'label' => 'Создать параметр',
                        'url'   => ['/config/default/create'],
                    ],
                    [
                        'label'   => 'Обновить параметр',
                        'url'     => ['/config/default/update'],
                        'options' => [
                            'style' => 'display:none;'
                        ]
                    ]
                ]
            ],
            [
                'icon'  => 'users',
                'label' => 'Пользователи',
                'url'   => ['/users/default/index'],
                'items' => [
                    [
                        'icon'  => 'users',
                        'label' => 'Пользователи',
                        'url'   => ['/users/default/index'],
                    ],
                    [
                        'icon'  => 'plus',
                        'label' => 'Создать пользователя',
                        'url'   => ['/users/default/create'],
                    ],
                    [
                        'label'   => 'Обновить пользователя',
                        'url'     => ['/users/default/update'],
                        'options' => [
                            'style' => 'display:none;'
                        ]
                    ]
                ]
            ],
            [
                'icon'  => 'list-alt',
                'label' => 'Справочники',
                'url'   => '#',
                'items' => [
                    [
                        'icon'  => 'reorder',
                        'label' => 'Виды спорта',
                        'url'   => ['/sport_types/default/index'],
                    ],
                    [
                        'icon'  => 'soccer-ball-o',
                        'label' => 'Турниры',
                        'url'   => ['/tournaments/default/index'],
                    ],
                    [
                        'icon'  => 'child',
                        'label' => 'Команды',
                        'url'   => ['/teams/default/index'],
                    ]
                ]
            ]
        ],
    ]);
    ?>
</section>