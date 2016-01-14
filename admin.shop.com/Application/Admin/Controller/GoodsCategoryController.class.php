<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/6
 * Time: 18:33
 */
namespace Admin\Controller;

use Think\Controller;
class GoodsCategoryController extends BaseController{
    protected $meta_title='商品分类';

    public function index(){
        $rows=$this->model->getTreeList();
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
    }

    protected function edit_view_before(){
        //准备页面上需要的ztree数据
        $rows=$this->model->getTreeList(true,'id,name,parent_id');
        $this->assign('zNodes',$rows);
    }
}