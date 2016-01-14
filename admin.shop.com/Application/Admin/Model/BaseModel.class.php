<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/7
 * Time: 15:24
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model{

    protected $patchValidate = true;
    public function getPageResult($wheres = array())
    {
        //获取列表数据  $wheres 是查询条件  array
        //查询出状态大于-1的数据
        if(in_array('status',$this->getDbFields())){
            $wheres['status'] = array('gt', -1);
        }
        //每页显示的条数
        $pageSize = C('PAGE_SIZE')==null?5:C('PAGE_SIZE');
        $totalRows = $this->where($wheres)->count();
        $page = new Page($totalRows, $pageSize);
        //总条数大于每页显示的条数时显示总条数
        if ($page->totalRows >= $page->listRows) {
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }
//        foreach($wheres as $key=>$val) {
//            $page->parameter .= "$key=".urldecode($val).'&';
//        }
//        if(in_array('keyword',$wheres)){
//            $page->parameter .= "keyword=".urlencode($wheres['keyword']).'&';
//        }
        //生成分页的html
        $pageHtml = $page->show();
        //查出每页显示的数据
        // $firstRow; 起始行数
        // $listRows; 列表每页显示行数
        $orders=array();
        if(is_array('sort',$this->getDbFields())){
            $orders['sort']='asc';
        }
       if($page->firstRow>=$totalRows && $page->firstRow>=1){
           $page->firstRow=$totalRows-$page->listRows;
       }
        $row = $this->order($orders)->where($wheres)->limit($page->firstRow, $page->listRows)->select();
        return array('rows' => $row, 'pageHtml' => $pageHtml);

    }

    public function changeStatus($id,$status=-1)
    {
        $data=array('status' => $status );
        if(is_array($id)){
            $data['id']=array('in',$id);
        }else{
            $data['id']=$id;
        }
        if($status==-1){
            $data['name']=array('exp',"concat(name,'_del')");
        }
        return parent::save($data);
    }

    //获取后台页面应显示的供应商列表
    public function getList()
    {
        $orders=array();
        if(is_array('sort',$this->getDbFields())){
            $orders['sort']='asc';
        }
        $wheres=array();
        if(is_array('sort',$this->getDbFields())){
            $wheres['status']=array('gt','-1');
        }
        return $this->order($orders)->where($wheres)->select();
    }
}