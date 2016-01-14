<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/6
 * Time: 18:34
 */

namespace Admin\Model;


use Admin\Controller\BaseController;
use Think\Model;
use Think\Page;

class SupplierModel extends BaseModel{
    // 自动验证定义
    protected $_validate = array(
        array('name','require','供应商名称不能为空'),
        array('name','','供应商名称重复,请重新输入!','','unique'),
        array('intro','require','供应商描述不能为空'),
    );


}