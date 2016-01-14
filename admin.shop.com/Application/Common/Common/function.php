<?php
/**
 * 显示model中的错误信息
 * @param $model
 * @return string  错误信息
 */
function show_model_error($model)
{
    $errors = $model->getError();
    $errorMsg = "<ul>";
    if (is_array($errors)) {
        foreach ($errors as $error) {
            $errorMsg .= "<li>{$error}</li>";
        }
    } else {
        $errorMsg .= "<li>{$errors}</li>";
    }
    $errorMsg .= "</ul>";
    return $errorMsg;
}


//返回二维数组中指定的一列
if(!function_exists('array_column')){
    function array_column($rows,$field){
        $value=array();
        foreach($rows as $row){
            $value[]=$row[$field];
        }
        return $value;
    }
}

