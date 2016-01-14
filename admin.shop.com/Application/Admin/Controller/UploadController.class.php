<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2016/1/13
 * Time: 13:07
 */

namespace Admin\Controller;


use Think\Controller;

class UploadifyController extends Controller{
    public function index(){
        $dir = I('post.dir');  //��ȡ�����ָ���ķ���(�ռ�)
        $config = array(
            //'rootPath'     => './Uploads/', //�����·��
            'rootPath'     => './', //���浽upyun�ĸ�·��
            //'savePath'     => $dir.'/', //����·��
            'driver'       => 'Upyun', // �ļ��ϴ�����
            'driverConfig' => array(
                'host'     => 'v0.api.upyun.com', //�����Ʒ�����
            'username' => 'itsource', //���Ĳ���Ա�û�
            'password' => 'itsource', //�����Ʋ���Ա����
            'bucket'   => $dir, //�ռ�����
            'timeout'  => 90, //��ʱʱ��
        ), // �ϴ���������
        );
        $uploader = new Upload($config);
        $result = $uploader->uploadOne($_FILES['Filedata']);
        if($result!==false){
            //���ϴ����·�����͸������
            echo $result['savepath'].$result['savename']; //���浽upyun�ϵĵ�ַ
        }else{
            echo $uploader->getError();
        }
    }

}