To use Elephants Group follow module first you must install module, then you can use follow widget anywhere in your website.

Installation Steps:
===

1) run
> php composer.phar require elephantsgroup/eg-follow "*"

or add `"elephantsgroup/eg-follow": "*"` to the require section of your composer.json file.

2) migrate database
> yii migrate --migrationPath=vendor/elephantsgroup/eg-follow/migrations

3) add follow module to common configuration (common/config.php file)

```'modules' => [
    ...
    'follow' => [
        'class' => 'elephantsGroup\follow\Module',
    ],
    ...
]```

4) open access to module in common configuration

```'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        ...
        'follow/ajax/*',
        ...
    ]
]```

5) filter admin controller in frontend configuration (frontend/config.php file)

```'modules' => [
    ...
    'follow' => [
        'as frontend' => 'elephantsGroup\follow\filters\FrontendFilter',
    ],
    ...
]```

5) filter ajax controller in backend configuration (backend/config.php file)

```'modules' => [
    ...
    'follow' => [
        'as backend' => 'elephantsGroup\follow\filters\BackendFilter',
    ],
    ...
]```

Using follow widget
===

Anywhere in your code you can use follow widget as follows:
```<?= Follows::widget() ?>```

You need to use Follows widget header in your page:
```use elephantsGroup\follow\components\Follows;```

Follow widget parameters
---

- item (integer): to separate follows between different items.
```<?= Follows::widget(['item' => 1]) ?>```
```<?= Follows::widget(['item' => $model->id]) ?>```

default value for item is 0
- service (integer): to separate follows between various item types.
```<?= Folloes::widget(['service' => 1, 'item' => $model->id]) ?>```

for example you can use different values for different modules in your app, and then use follow widget separately in modules.
default value for service is 0
- color (string): color of unfollowed icon heart, default 'black'
```<?= Follows::widget(['service' => 1, ''item' => $model->id, 'color' => 'yellow']) ?>```

- view_file (string): the view file path for rendering

```<?= Follows::widget([
    'service' => 1,
    'item' => $model->id,
    'color' => 'yellow',
    'view_file' => Yii::getAlias('@frontend') . '/views/follow/widget.php'
]) ?>```

you can use these variables in your customized view:
* service
* item
* color
* is_follow
