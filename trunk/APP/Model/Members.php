<?php

/**
 * Model_Members 封装了对成员信息的所有操作
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Model_Members
{
    /**
     * 提供成员信息数据库访问服务的对象
     *
     * @var Model_Members
     */
    var $_tbMembers;

    /**
     * 构造函数
     *
     * @return Model_Members
     */
    function Model_Members() {
        $this->_tbMembers =& FLEA::getSingleton('Table_Members');
    }
    
    /**
     * 根据用户名(登录名)查找用户
     * 
     * @return array 用户信息数组
     */ 
    function findByUsername($username) {
        return $this->_tbMembers->findByUsername($username);
    }
    
    /**
     * 检查用户的密码是否正确
     * 
     * @return bool
     */
    function checkPassword($cleartext, $cryptograph) {
        return $this->_tbMembers->checkPassword($cleartext, $cryptograph);
    }
    
    /**
     * 获取指定 ID 的成员信息
     *
     * @param int $memberId
     *
     * @return array
     */
    function getMember($memberId) {
        return $this->_tbMembers->find((int)$memberId);
    }

    /**
     * 保存成员信息
     *
     * @param array $member
     *
     * @return boolean
     */
    function saveMember($member) {
        $memberkey = $this->_tbMembers->primaryKey;
        echo $member[$memberkey];
        if (isset($member[$memberkey]) && (int)$member[$memberkey] == 0) {
            unset($member[$memberkey]);
        }
        
        $memberid = $this->_tbMembers->save($member);
        
        $this->_uploadPicture($memberid, 'headimg', 'headimage');
        $this->_uploadPicture($memberid, 'photo', 'photo');

        return;
    }

    /**
     * 删除指定的成员信息
     *
     * @param int $memberId
     *
     * @return boolean
     */
    function removeMember($memberId) {
        $memberId = (int)$memberId;
        $member = $this->_tbMembers->find($memberId);
        if (!$member) {
            FLEA::loadClass('Exception_DataNotFound');
            __THROW(new Exception_DataNotFound($memberId));
            return false;
        }
        
        // 删除该用户的图片
        $uploadDir = FLEA::getAppInf('uploadDir') . DS;
        if ($member['headimg'] != '' && $member['headimg'] != 'defaulthead.jpg') {
            unlink($uploadDir . $member['headimg']);
        }
        if ($member['photo'] != '') {
            unlink($uploadDir . $member['photo']);
        }

        return $this->_tbMembers->removeByPkv($memberId);
    }
    
    /**
     * 处理图片上传
     */
    function _uploadPicture($memberid, $imgfile, $pictureType) {
        $uploader =& FLEA::getSingleton('FLEA_Helper_FileUploader');
        /* @var $uploader FLEA_Helper_FileUploader */

        // 检查上传文件是否存在
        if (!$uploader->isFileExist($imgfile)) {
            $errorMessage = _T('ui_p_upload_failed');
            return;
        }

        // 检查文件扩展名是否是允许上传的类型
        $file =& $uploader->getFile($imgfile);
        if (!$file->check(FLEA::getAppInf('imageFileExts'))) {
            $errorMessage =_T('ui_p_invalid_filetype');
            return;
        }
        
        $member = $this->getMember($memberid, false);
        if (!$member) {
            FLEA::loadClass('Exception_DataNotFound');
            __THROW(new Exception_DataNotFound($memberid));
            return false;
        }

        // 上传图像
        if ($pictureType == 'headimage') {
            $this->_uploadThumb($member, $file);
        } else {
            $this->_uploadPhoto($member, $file);
        }
        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            $errorMessage = $ex->getMessage();
            return;
        }
    }


    /**
     * 上传成员头像图片
     *
     * @param FLEA_Helper_UploadFile $file
     *
     * @return boolean
     */
    function _uploadThumb($member, & $file) {
        // 将缩略图文件裁减为指定大小，并保存起来
        FLEA::loadClass('FLEA_Helper_Image');
        $image =& FLEA_Helper_Image::createFromFile($file->getTmpName(), $file->getExt());
        $image->crop(FLEA::getAppInf('thumbWidth'), FLEA::getAppInf('thumbHeight'));
        $filename = $member['member_id'] . '-thumb-t' . time() . '.jpg';
        $image->saveAsJpeg(FLEA::getAppInf('uploadDir') . DS . $filename);
        $image->destory();
        
         // 更新数据库
        if ($member['headimage'] != '' && $member['headimage'] != 'defaulthead.jpg') {
            unlink(FLEA::getAppInf('uploadDir') . DS . $member['headimage']);
        }

        $member['headimage'] = $filename;
        return $this->_tbMembers->update($member);
    }
    
    /**
     * 上传成员照片
     *
     * @param FLEA_Helper_UploadFile $file
     *
     * @return boolean
     */
    function _uploadPhoto($member, & $file) {
        // 将照片文件裁减为指定大小，并保存起来
        FLEA::loadClass('FLEA_Helper_Image');
        $image =& FLEA_Helper_Image::createFromFile($file->getTmpName(), $file->getExt());
        $image->crop(FLEA::getAppInf('photoWidth'), FLEA::getAppInf('photoHeight'));
        $filename = $member['member_id'] . '-photo-t' . time() . '.jpg';
        $image->saveAsJpeg(FLEA::getAppInf('uploadDir') . DS . $filename);
        $image->destory();

        // 更新数据库
        if ($member['photo'] != '') {
            unlink(FLEA::getAppInf('uploadDir') . DS . $member['photo']);
        }

        $member['photo'] = $filename;
        return $this->_tbMembers->update($member);
    }

    /**
     * 返回 Table_Members 对象
     *
     * @return Table_Members
     */
    function & getTable() {
        return $this->_tbMembers;
    }
}
