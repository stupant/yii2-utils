# yii2-utils

Yii2 common utils is a set of common used tools for Yii2 framework.

* `stupant\utils\PTotal`: Display totals for column footer in Gridview.
* `stupant\utils\BigDataActiveDataProvider`: Gradually select data for big tables.
* `stupant\utils\GridView`: Plain GridView table generate without any JS.

## Usage

### PTotal

Display the total of a numeric data column.

```
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'footerRowOptions' => ['class' => 'text text-success bg-success'],
    'columns' => [
      ...
      [
        'attribute' => 'cnt',
        'label' => Yii::t('app', 'Count'),
        'format' => 'integer',
        'footer' => Yii::$app->formatter->format(stupant\utils\PTotal::pageTotal($dataProvider->models, 'cnt'), 'integer')
      ],
      ...
    ],
]); ?>
```

### GridView

Show a GridView without any assets bundle. Best for display data without pagination situation (export data / email templates...)

```
<?= stupant\utils\GridView::widget([
    'dataProvider' => $dataProvider,
]); ?>

```

### BigDataActiveDataProvider

Only retrieve more records if required. Suitable for big data tables.

```
$dataProvider = new BigDataActiveDataProvider([
  'query' => ActiveRecord::find()
]);
```
