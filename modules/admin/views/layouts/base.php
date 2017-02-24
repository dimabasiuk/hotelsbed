<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AdminAsset;
use app\assets\AppAsset;
AdminAsset::register($this);

$this->beginContent('@app/modules/admin/views/layouts/_clear.php')
?>
<div class = "wrapper">
    <?php echo $content ?>
</div>

<?php $this->endContent() ?>
