<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/14
 * Time: 13:44
 */

namespace Admin\Model;


class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel{
    /**
     * DB connect
     *
     * @access public
     *
     * @return resource connection link
     */
    public function connect()
    {
        // TODO: Implement connect() method.
        echo 'connect';
        exit;
    }

    /**
     * Disconnect from DB
     *
     * @access public
     *
     * @return viod
     */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect';
        exit;
    }

    /**
     * Free result
     *
     * @access public
     * @param resource $result query resourse
     *
     * @return viod
     */
    public function free($result)
    {
        // TODO: Implement free() method.
        echo 'free';
        exit;
    }

    /**
     * Execute simple query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return resource|bool query result
     */
    public function query($sql, array $args = array())
    {
        //得到实际的sql语句
        $tempSql=$this-> buildSql(func_get_args());
//        var_dump($tempSql);
        return M()->execute($tempSql);
    }

    /**
     * Insert query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false last insert id
     */
    public function insert($sql, array $args = array())
    {
        $params=func_get_args();
        $sql=array_shift($params);
        $table_name=array_shift($params);
        $sql=str_replace('?T',$table_name,$sql);
//        var_dump($sql);
//        var_dump($table_name);
        $params=array_shift($params);
        $values='';
        foreach($params as $k=>$v){
            $values.="{$k}='{$v}',";
        }
//        var_dump($values);
        $values=rtrim($values,',');
        $sql=str_replace('?%',$values,$sql);
//        var_dump($sql);
        $model=M();
        $rst=$model->execute($sql);
        if($rst===false){
            return false;
        }else{
            return $model->getLastInsID();
        }

    }

    /**
     * Update query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false affected rows
     */
    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo 'update';
        exit;
    }

    /**
     * Get all query result rows as associated array
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo 'getAll';
        exit;
    }

    /**
     * Get all query result rows as associated array with first field as row key
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo 'getAssoc';
        exit;
    }

    /**
     * Get only first row from query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array
     */
    public function getRow($sql, array $args = array())
    {
////        var_dump(func_get_args());
////        echo '<pre>';
//        //得到传递过来的参数,拼装成sql语句
//        $params=func_get_args();
//        //弹出数组中的第一个作为sql语句
//        $sql=array_shift($params);
////        var_dump($sql);
////        var_dump($params);
//        $sqls=preg_split('/\?[FNT]/',$sql);
////        var_dump($sqls);
//        $tempSql='';
//        foreach($sqls as $k=>$v){
//            $tempSql.=($v.$params[$k]);
//        }

        $tempSql=$this-> buildSql(func_get_args());
        $row=M()->query($tempSql);
        return empty($row)?false:$row[0];
    }

    /**
     * Get first column of query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array one level data array
     */
    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo 'getCol';
        exit;
    }

    /**
     * Get one first field value from query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return string field value
     */
    public function getOne($sql, array $args = array())
    {
        $temlSql=$this->buildSql(func_get_args());
//        var_dump($temlSql);
        $rows=M()->query($temlSql);//二维数组
        $row=$rows[0];//一位数组
        return array_values($row);//返回一个值
    }

    private function buildSql($params){
        $sql=array_shift($params);
        $sqls=preg_split('/\?[FNT]/',$sql);
        $tempSql='';
        foreach($sqls as $k=>$v){
            $tempSql.=($v.$params[$k]);
        }
        return $tempSql;
    }
}