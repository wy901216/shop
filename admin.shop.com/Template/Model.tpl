
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

class <?php echo $name ?>Model extends BaseModel{
    // 自动验证定义
    protected $_validate = array(
        <?php
        foreach($fields as $field){
            if($field['Key']=='PRI' || $field['Null']=='YES'){
                continue;
            }
            echo "array('{$field['field']}','require','{$field['Comment']}不能为空',self::EXISTS_VALIDATE,self::MODEL_BOTH),\r\n";
        }
        ?>
    );
}