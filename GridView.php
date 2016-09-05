<?php
namespace stupant\utils;

use yii\grid\GridView as BaseGridView;
use yii\widgets\BaseListView;
use Yii;

class GridView extends BaseGridView {
  public $tableOptions = [
    'class' => 'table table-striped table-bordered',
    'style' => 'width:100%',
    'border'=>"1",
    'width'=>"100%"
  ];
  /**
   * Runs the widget.
   */
  public function run()
  {
      $id = $this->options['id'];
      $this->dataProvider->sort = false;
      $this->dataProvider->pagination = false;
      $this->formatter->nullDisplay = '-';
      BaseListView::run();
  }
}
?>
