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

class BrandModel extends BaseModel{
    // 自动验证定义
    protected $_validate = array(
        array('name','require','名称不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        array('logo','require','LOGO不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        array('site_url','require','网址不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        array('sort','require','排序不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        array('status','require','状态不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        );
}