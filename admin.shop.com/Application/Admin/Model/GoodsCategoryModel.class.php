<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/6
 * Time: 18:34
 */
namespace Admin\Model;

use Admin\Service\NestedSetsService;
use Think\Model;

class GoodsCategoryModel extends BaseModel{
    // 自动验证定义
    protected $_validate = array(
        array('','require','分类名称不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        array('','require','父分类不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
        array('','require','是否显示不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),
    );

    public function getTreeList($isJSON=false,$field='*'){
        $rows=$this->field($field)->order('lft')->where(array('status'=>array('egt',0)))->select();
        if($isJSON){
            return json_encode($rows);
        }else{
            return $rows;
        }
    }

    public function add(){
        //创建可能够执行sql的对象
        $dbMysql=new DbMysqlInterfaceImplModel();
        //计算边界
        $nestedSetsService=new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
        //添加的节点放在哪个父节点下面,并且返回插入后生成的id
        return $nestedSetsService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    public function save(){
        //创建可能够执行sql的对象
        $dbMysql=new DbMysqlInterfaceImplModel();
        //计算边界
        $nestedSetsService=new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
        //将指定的节点移动到合适的父分类下
        $nestedSetsService->moveUnder($this->data['id'],$this->data['parent_id'],'bottom');
        //更新数据
        parent::save();
    }

    //移除和改变状态时,不仅移除或改变了自己的状态,而且还移除或改变了子孙的状态
    public function changeStatus($id,$status=-1)
    {
        //根据自己的id,找到自己和子孙节点
        $sql="select child.id from goods_category as child, goods_category as parent where parent.id={$id} and child.lft>=parent.lft and child.rgt<=parent.rgt;";
        $rows=$this->query($sql);
        $id=array_column($rows,'id');
//        foreach($rows as $row){
//            $id[]=$row['id'];
//        }
        $data=array('status' => $status, 'id'=>array('in',$id));
//        if(is_array($id)){
//            $data['id']=array('in',$id);
//        }else{
//            $data['id']=$id;
//        }
        if($status==-1){
            $data['name']=array('exp',"concat(name,'_del')");
        }
        return parent::save($data);
    }
}