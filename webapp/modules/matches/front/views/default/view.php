<?php
    use yii\web\View;

    Yii::$app->view->registerJs('var match_data = \'' . $model->getGroupBets() . '\'',  View::POS_HEAD);
?>
<div id="match-data"></div>