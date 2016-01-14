<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/8
 * Time: 19:21
 */
namespace Admin\Controller;

use Think\Controller;

class GiiController extends Controller
{
    public function index(){
        if(IS_POST){
            //生成控制器
            //接收数据
            $table_name=I('post.table_name');
            if(empty($table_name)){
                $this->error('请输入表名!');
            }
            //获取表名
            $name=parse_name($table_name,1);
            //通过表的注释获取meta_title的值
            $sql="show table status where name='{$table_name}'";
            $rows=M()->query($sql);
            $meta_title=$rows[0]['Comment'];
            $sql2="show full columns from {$table_name}";
            $fields=M()->query($sql2);
//            var_dump($fields);exit;
//            var_dump($meta_title);
            foreach($fields as &$field){
                $comment=$field['Comment'];
                if(strpos($comment,'@')!==false){
                    $pattern='/(.*)@([a-z]*)\|?(.*)/';
                    preg_match($pattern,$comment,$result);
                    $field['Comment']=$result[1];
                    $field['Field_type']=$result[2];
                    if(!empty($result[3])){
                        parse_str($result[3],$option_values);
                        $field['option_values']=$option_values;
                    }
                }
            }
//            var_dump($fields);exit;
            unset($field);
            //引入控制器模板文件
            define('TEMPLATE_PATH') or define('TEMPLATE_PATH',ROOT_PATH.'Template/');
//            var_dump(TEMPLATE_PATH);exit;
            //开启缓存,获取缓存内容
            ob_start();
            require TEMPLATE_PATH.'Controller.tpl';
//            var_dump(MODULE_PATH);exit;
            $controller_content="<?php\r\n".ob_get_clean();
//            var_dump($controller_content);
//            exit;
            $controller_dir=MODULE_PATH.'Controller/';
            $controller_path=$controller_dir.$name.'Controller.class.php';
            file_put_contents($controller_path,$controller_content);

            //生成模型
            ob_start();
            require TEMPLATE_PATH.'Model.tpl';
            $model_content='<?php'.ob_get_clean();
//            var_dump($controller_content);
            $model_dir=MODULE_PATH.'Model/';
            $model_path=$model_dir.$name.'Model.class.php';
            file_put_contents($model_path,$model_content);

            //生成视图显示页面
            ob_start();
            require TEMPLATE_PATH.'index.tpl';
            $index_content='<?php'.ob_get_clean();
            $index_dir=APP_PATH.'Admin/View/'.$name;
            if(!is_dir($index_dir)){
                mkdir($index_dir,0777,true);
            }
            $index_path=$index_dir.'/index.html';
            file_put_contents($index_path,$index_content);

            //生成编辑页面
            ob_start();
            require TEMPLATE_PATH.'edit.tpl';
            $edit_content='<?php'.ob_get_clean();
            $edit_dir=APP_PATH.'Admin/View/'.$name;
            if(!is_dir($edit_dir)){
                mkdir($edit_dir,0777,true);
            }
            $edit_path=$edit_dir.'/edit.html';
            file_put_contents($edit_path,$edit_content);

            $this->success('生成成功!');
        }else{
            $this->display('index');
        }





    }
}