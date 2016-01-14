<extend name="Common:edit"/>

<block name="form">
    <div class="main-div">
        <form method="post" action="{:U()}" enctype="multipart/form-data">
            <table cellspacing="1" cellpadding="3" width="100%">
                <?php foreach($fields as $field):
                    if($field['Field']=='id'){
                        continue;
                    }
                ?>
                <tr>
                    <td class="label"><?php echo $field['Comment']?></td>
                    <td>
                        <?php
                           //就是根据数据表字段的注解生成不同的表单元素
                        if(!isset($field['Field_type'])){
                           //如果没有指定类型, 默认为text类型的表单元素
                           if($field['Field']=='sort'){
                             echo "<input type='text' name='{$field['Field']}' maxlength='60' value='{\$sort|default=20}' />";
                            }else{
                            echo "<input type='text' name='{$field['Field']}' maxlength='60' value='{\${$field['Field']}}' />";
                            }


                        }elseif($field['Field_type']=='textarea'){
                        //生成多行文本框
                            echo "<textarea  name='{$field['Field']}' cols='60' rows='4'  >{\${$field['Field']}}</textarea>";
                        }elseif($field['Field_type']=='radio'){
                            //生成单选框
                            foreach($field['option_values'] as $k=>$v){
                            echo "<input type='radio' class='{$field['Field']}' name='{$field['Field']}' value='{$k}'/> {$v}";
                            }
                        }elseif($field['Field_type']=='file'){
                            echo "<input type='file' name='{$field['Field']}' maxlength='60'/>";
                        }
                        ?>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <?php endForeach; ?>
                <tr>
                    <td colspan="2" align="center"><br />
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="submit" class="button ajax-post" value=" 确定 " />
                        <input type="reset" class="button" value=" 重置 " />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</block>
