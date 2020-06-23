<?php

namespace app\modules\rest\models;

use app\modules\matches\models\Matches;

/**
 * Override Matches logic here
 *
 * @package app\modules\rest\models
 * 
 */
class MatchesData extends Matches
{

    public function fields()
    {
        return [
            'id',
            'data' => function ($model) {
                return $model->getGroupBets();
            }
        ];
    }

}
