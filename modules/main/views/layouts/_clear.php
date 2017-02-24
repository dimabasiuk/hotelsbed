<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?php echo Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,600,700&amp;amp;subset=cyrillic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700&amp;amp;subset=cyrillic">

    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
    <?php $this->registerLinkTag([
        'rel' => 'shortcut icon',
        'type' => 'image/x-icon',
        'href' => '/favicon.ico',
    ]);?>

</head>
<body>
    <div id="page-wrapper">
        <?php $this->beginBody() ?>
            <?php echo $content ?>

        <?php $this->endBody() ?>
    </div>
</body>

</html>
<?php $this->endPage() ?>
