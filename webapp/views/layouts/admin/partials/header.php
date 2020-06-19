<?php

    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;

?>
<header class="main-header">
    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-static-top',
            'role' => 'navigation'
        ],
        'renderInnerContainer' => false
    ]);

    echo Html::a('<span class="sr-only">Toggle navigation</span>', 'javascript:void(0)', ['class' => 'sidebar-toggle', 'data-toggle' => 'offcanvas', 'role' => 'button']);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right', 'style' => 'margin-right: 15px;'],
        'items' => [
                [
                'label' => Yii::$app->user->identity->username,
                'items' => [
                        [
                        'label' => 'Редактировать профиль',
                        'url' => yii\helpers\Url::to(['/users/default/update', 'id' => Yii::$app->user->identity->id]),
                    ],
                        [
                        'label' => 'Выйти',
                        'url' => yii\helpers\Url::to(['/users/default/logout']),
                        'linkOptions' => ['data-method' => 'post']
                    ]
                ]
            ],
        ],
    ]);

    NavBar::end();
    ?>
</header>