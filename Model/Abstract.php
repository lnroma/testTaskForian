<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.10.15
 * Time: 12:46
 */
class Model_Abstract
{

    private $_tableName = null;
    private $_idEntity = null;
    private $_selectArray = null;
    private $_pageSize = null;
    private $_pageCout = null;
    private $_order = null;
    private $_dataToSave = array();
    private $_whereStatement = '';

    /**
     * get table name
     * @return null
     * @throws Exception
     */
    public function getTableName()
    {
        if (is_null($this->_tableName)) {
            throw new Exception('Please call setTableName');
        } else {
            return $this->_tableName;
        }
    }

    /**
     * set table name
     * @param $name
     * @return $this
     */
    public function setTableName($name)
    {
        $this->_tableName = $name;
        return $this;
    }

    /**
     * set table entity
     * @param $id
     * @return $this
     */
    public function setTableIdEntity($id)
    {
        $this->_idEntity = $id;
        return $this;
    }

    /**
     * set field to select
     * @param $fieldArray
     * @return $this
     */
    public function setFieldToSelect($fieldArray)
    {
        $this->_selectArray = $fieldArray;
        return $this;
    }

    /**
     * set count mat on page
     * @param $count
     * @return $this
     */
    public function setPageSize($count)
    {
        $this->_pageSize = $count;
        return $this;
    }

    /**
     * set Page number
     * @param $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->_pageCout = $page;
        return $this;
    }

    /**
     * get start limit
     * @return int|null
     */
    protected function _getStartLimit()
    {
        if (is_null($this->_pageCout)) {
            return 0;
        } else {
            return $this->_getOffset() * $this->_pageCout;
        }
    }

    /**
     * add field to filter
     * @param $field
     * @param array $filters
     */
    public function addFieldToFilter($field,$filters)
    {
        if(!is_array($filters)) {
            $filters = array(
                'eq' => $filters
            );
        }

        foreach($filters as $val) {
            $myKey = key($filters);

            if($this->_whereStatement != '') {
                $this->_whereStatement .= ' AND ';
            }

            if($myKey == 'eq') {
                $this->_whereStatement .= '`' . $field . '` = "' . $val . '" ';
            } elseif ($myKey == 'neq') {
                $this->_whereStatement .= '`' .$field . '` != "' . $val .'"';
            } elseif ($myKey == 'gt') {
                $this->_whereStatement .= '`'.$field.'` > "'.$val.'" ';
            } elseif ($myKey == 'lt') {
                $this->_whereStatement .= '`'.$field.'` < "'.$val.'" ';
            } elseif ($myKey == 'in') {
                $this->_whereStatement .= '`'.$field.'` IN ('.trim(implode(',',$val),',').') ';
            }
        }

        return $this;
    }

    /**
     * get offset for limit
     * @return int|null
     */
    protected function _getOffset()
    {
        if (is_null($this->_pageSize)) {
            return 30;
        } else {
            return $this->_pageSize;
        }
    }

    /**
     * setOrder
     * @param $field
     * @param $order
     * @return $this
     */
    public function setOrder($field, $order)
    {
        $this->_order = 'ORDER BY `' . $field . '` ' . $order;
        return $this;
    }

    /**
     * load collection
     * @param null $id
     * @return array
     * @throws Exception
     */
    public function load($id = null)
    {
        /** @var PDO $connection */
        $res = Core_Db::getResource();

        if (!is_null($this->_selectArray)) {
            $selectField = '`' . implode('`.`', $this ->_selectArray) . '`';
        } else {
            $selectField = '*';
        }

        $query = 'select ' . $selectField . ' from `' . $this->_tableName . '`';

        if (!is_null($id) && $this->_whereStatement == '') {
            $query .= ' where `' . $this->_idEntity . '` = ' . $id;
        } elseif($this->_whereStatement != '') {
            $query .= ' where '.$this->_whereStatement;
        }

        if (!is_null($this->_order)) {
            $query .= ' '.$this->_order;
        }

        $query .= ' LIMIT ' . $this->_getStartLimit() . ',' . $this->_getOffset();

        return $res->query($query)->fetchAll();
    }

    /**
     * get count string in query
     * @return array
     * @throws Exception
     */
    public function getCount() {

        /** @var PDO $connection */
        $res = Core_Db::getResource();

        if (!is_null($this->_selectArray)) {
            $selectField = '`' . implode('`.`', $this ->_selectArray) . '`';
        } else {
            $selectField = '*';
        }

        $query = 'select count(*) as `cnt` from `' . $this->_tableName . '`';

        if ($this->_whereStatement != '') {
            $query .= 'where '.$this->_whereStatement;
        }

        return $res->query($query)->fetchObject();
    }

    /**
     * add to save field
     * @param $array
     * @return mixed
     * @throws Exception
     */
    public function addDataToSave($array)
    {
        $arrayColumn = array();
        $arrayMask = array();
        $arrayVal = array();
        foreach ($array as $key => $val) {
            $arrayColumn[] = $key;
            if ($key == $this->_idEntity) {
                $arrayMask[] = 'NULL';
            } else {
                $arrayMask[] = '?';
                $arrayVal[] = $val;
            }
        }

        $query = 'INSERT INTO `'
            . $this->_tableName . '` (' . trim(implode(',', $arrayColumn), ',')
            . ') VALUES('
            . trim(implode(',', $arrayMask), ',')
            . ');';
        try {
            $res = Core_Db::getResource();
            $res->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $res->prepare($query);
            $result = $sth->execute($arrayVal);
        } catch (Exception $error) {
            throw new Exception('Произошла ошибка при сохранение данных');
        } catch (PDOException $erroExc) {
            throw new Exception('Произошла ошибка при сохранение данных');
        }
        return $result;
    }

}