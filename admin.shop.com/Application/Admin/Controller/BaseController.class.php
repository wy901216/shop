<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/7
 * Time: 15:24
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller{

    protected $model;
    protected $meta_title='';
    public function _initialize(){
        $this->model=D(CONTROLLER_NAME);
    }
    public function index()
    {
        $keyword = I('get.keyword', '');
        $wheres = array();
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%{$keyword}%");
        }

        /**添加分页
         * 获取的结果中包含所有的数据和分页工具条
         * $pageResult=array(
         * 'rows'=>数据库库中的数据
         *      'pageHtml'=>分页工具条html
         * )
         ***/
        $pageResult = $this->model->getPageResult($wheres);
        $this->assign($pageResult);
        $this->assign('meta_title',$this->meta_title);
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->display('index');
    }

    public function add()
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->add() !== false) {
                    $this->success('添加成功!', cookie('__forward__'));
                    return;
                }
            }
            $this->error('操作失败!' . show_model_error($this->model));
        } else {
            $this->edit_view_before();
            $this->assign('meta_title','添加'.$this->meta_title);
            $this->display('edit');
        }
    }

    //此方法是用来被子类覆盖,为编辑页面展示数据
    protected function edit_view_before(){

    }


    public function edit($id)
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->save() !== false) {
                    $this->success('修改成功!', cookie('__forward__'));
                    return;
                }
            }
            $this->error('操作失败!' . show_model_error($this->model));
        } else {
            $row = $this->model->find($id);
            $this->assign($row);
            $this->edit_view_before();
            $this->assign('meta_title','编辑'.$this->meta_title);
            $this->display('edit');
        }
    }

    public function changeStatus($id,$status=-1)
    {
        if ($this->model->changeStatus($id,$status)!== false) {
            $this->success('操作成功!', cookie('__forward__'));
        } else {
            $this->error('操作失败!' . show_model_error($this->model));
        }
    }



}