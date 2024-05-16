<?php

namespace app\widgets\commentWidget;

use app\components\model\CoreActiveRecord;
use yii\base\Widget;

class CommentWidget extends Widget
{
    public CoreActiveRecord $targetModel;
    public CoreActiveRecord $commentModel;
}