<extend name="Common:index"/>

<block name="list">
    <form method="post" action="" name="listForm">
        <input type="button" value=" 删除 " class="button ajax-post" url="{:U('changeStatus')}"/>
        <input type="button" value=" 显示 " class="button ajax-post" url="{:U('changeStatus',array('status'=>1))}"/>
        <input type="button" value=" 隐藏 " class="button ajax-post" url="{:U('changeStatus',array('status'=>0))}"/>
        <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1">
                <tr>
                    <th width="10px">全选<input type="checkbox" class="check_all"/></th>
                    <?php foreach($fields as $field):
                        if($field['Key']=='PRI'){
                            continue;
                        }
                    ?>
                    <th><?php echo $field['Comment']?></th>
                    <?php endforeach;?>
                    <th>操作</th>
                </tr>
                <volist name="rows" id="row">
                    <tr>
                        <td><input type="checkbox" class="id" name="id[]" value="{$row.id}"/></td>
                        <td class="first-cell">{$row.name}</td>
                        <?php foreach($fields as $field):
                        if($field['Key']=='PRI' || $field['Field']=='name'){
                            continue;
                        }
                        if($field['Field']=='status'){
                            echo "<td align=\"center\"><a class=\"ajax-get\" href=\"{:U('changeStatus',array('id'=>\$row['id'],'status'=>1-\$row['status']))}\"><img src=\"__IMG__/{\$row['status']}.gif\" /></a></td>";
                            continue;
                        }
                        ?>
                        <td align="center">{$row.<?php echo $field['Field']?>}</td>
                        <?php endforeach;?>
                        <td align="center">
                            <a href="{:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a>
                            <a class="ajax-get" href="{:U('changeStatus',array('id'=>$row['id']))}" title="编辑">移除</a>
                        </td>
                    </tr>
                </volist>
                <tr>
                    <td align="right" nowrap="true" colspan="8">
                        <div id="turn-page" class="page">
                            {$pageHtml}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</block>