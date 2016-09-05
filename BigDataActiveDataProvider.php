<?php
namespace stupant\utils;

use yii\data\ActiveDataProvider;
use yii\base\InvalidConfigException;
use yii\db\QueryInterface;

class BigDataActiveDataProvider extends ActiveDataProvider
{
    protected function prepareTotalCount() {
        return 0;
    }

    protected function prepareModels()
    {
        if (!$this->query instanceof QueryInterface) {
            throw new InvalidConfigException('The "query" property must be an instance of a class that implements the QueryInterface e.g. yii\db\Query or its subclasses.');
        }
        $query = clone $this->query;

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->validatePage = false;
            $page = $pagination->getPage(true);
            $offset = $page*$pagination->getPageSize();
            $query->limit($limit = $pagination->getLimit() + 1)->offset($offset);
            \Yii::trace("Limit: $limit, Offset: $offset, Page: $page");
        }
        if (($sort = $this->getSort()) !== false) {
            $query->addOrderBy($sort->getOrders());
        }

        $res = $query->all($this->db);

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = ($page + 1)*$pagination->getPageSize();
            \Yii::trace("Pagination First: " . $pagination->totalCount);
            if (count($res) > $pagination->getPageSize()) {
                unset($res[count($res)-1]);
                $pagination->totalCount++;
            }
            \Yii::trace("Pagination Last: " . $pagination->totalCount);
        }

        return $res;
    }


}
