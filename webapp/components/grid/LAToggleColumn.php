<?php

namespace app\components\grid;

use dosamigos\grid\columns\ToggleColumn;

class LAToggleColumn extends ToggleColumn
{

    public $onValue = 1;
    public $onLabel = 'Да';
    public $offLabel = 'Нет';
    public $contentOptions = ['class' => 'col-md-1 text-center'];
    public $headerOptions = ['class' => 'col-md-1'];
    public $filter = [
        1 => 'Активный',
        0 => 'Не активный'
    ];

}
