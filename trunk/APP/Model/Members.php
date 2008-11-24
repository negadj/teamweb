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
        if (isset($member[$memberkey]) && (int)$member[$memberkey] == 0) {
            unset($member[$memberkey]);
        }

        return $this->_tbMembers->save($member);
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
        // 删除该用户的头像图片
        $uploadDir = FLEA::getAppInf('uploadDir') . DS;
        if ($member['HeadImage'] != '' && $member['HeadImage'] != 'defaulthead.jpg') {
            unlink($uploadDir . $member['HeadImage']);
        }

        return $this->_tbMembers->removeByPkv($memberId);
    }


    /**
     * 上传成员头像图片
     *
     * @param int $memberId
     * @param FLEA_Helper_UploadFile $file
     *
     * @return boolean
     */
    function uploadThumb($memberId, & $file) {
        $memberId = (int)$memberId;
        $member = $this->getMember($memberId, false);
        if (!$member) {
            FLEA::loadClass('Exception_DataNotFound');
            __THROW(new Exception_DataNotFound($memberId));
            return false;
        }

        // 将缩略图文件裁减为指定大小，并保存起来
        FLEA::loadClass('FLEA_Helper_Image');
        $image =& FLEA_Helper_Image::createFromFile($file->getTmpName(), $file->getExt());
        $image->crop(FLEA::getAppInf('thumbWidth'), FLEA::getAppInf('thumbHeight'));
        $filename = $memberId . '-thumb-t' . time() . '.jpg';
        $image->saveAsJpeg(FLEA::getAppInf('uploadDir') . DS . $filename);
        $image->destory();

        // 更新数据库
        if ($member['HeadImage'] != '' && $member['HeadImage'] != 'defaulthead.jpg') {
            unlink(FLEA::getAppInf('uploadDir') . DS . $member['HeadImage']);
        }

        $member['HeadImage'] = $filename;
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
