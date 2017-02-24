<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 05.11.16
 * Time: 11:13
 */
?>
<?php echo \app\modules\admin\components\widgets\Menu::widget([
    'options'=>['class'=>'sidebar-menu'],
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate'=>"<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents'=>true,
    'items'=>[

        [
            'label'=>Yii::t('admin','Контент'),
            'url' => '#',
            'icon'=>'<i class="fa fa-edit"></i>',
            'options'=>['class'=>'treeview'],
           // 'visible'=>Yii::$app->user->can('administrator'),
            'items'=>[
                [
                    'label'=> Yii::t('admin','menus'),
                    'url'=>['/admin/page/browse'],
                    'icon'=>'<i class="fa fa-angle-double-right"></i>',

                ],
                [
                    'label'=> Yii::t('admin','Страницы'),
                    'url'=>['/admin/page/browse'],
                    'icon'=>'<i class="fa fa-angle-double-right"></i>',

                ],

            ]
        ],
        [
            'label'=>Yii::t('admin', 'Пользователи'),
            'icon'=>'<i class="fa fa-users"></i>',
            'url'=>['/admin/user/index'],
            //'visible'=>Yii::$app->user->can('administrator')
        ],

        [
            'label'=>Yii::t('admin', 'Настройки'),
            'url' => '#',
            'icon'=>'<i class="fa fa-cogs"></i>',
            'options'=>['class'=>'treeview'],
            'visible'=>Yii::$app->user->can('administrator'),
            'items'=>[
                ['label'=>Yii::t('admin', 'Основные настройки'), 'url'=>['/admin/settings/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                [
                    'label'=>Yii::t('admin', 'Переводы сообщений'),
                    'url'=>['#'],
                    'icon'=>'<i class="fa fa-angle-double-right"></i>',
                    'items' => [
                        ['label'=>Yii::t('admin', 'Базовые сообщения'), 'url'=>['/admin/source-message/index'], 'icon'=>'<i class="fa fa-angle-right"></i>'],
                        ['label'=>Yii::t('admin', 'Переводы сообщений'), 'url'=>['/admin/message/index'], 'icon'=>'<i class="fa fa-angle-right"></i>'],

                    ]

                ],

            ]
        ]
    ]
]) ?>
