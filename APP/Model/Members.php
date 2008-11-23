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
     * 获取用户的角色信息
     * 
     * @return array 角色数组
     */
    function fetchRoles($member) {
        return $this->_tbMembers->fetchRoles($member);
    }

    /**
     * 验证指定的用户名和密码是否正确，验证成功则更新用户的登录信息
     *
     * @param string $username 用户名
     * @param string $password 密码
     * @param boolean $returnUserdata 指示验证通过后是否返回用户数据
     *
     * @return boolean|array
     *
     * @access public
     */
    function validateUser($username, $password, $returnUserdata = false) {
        return $this->_tbMembers->validateUser($username, $password, $returnUserdata);
    }
    
    /**
     * 更新指定用户的密码
     *
     * @param string $username 用户名
     * @param string $oldPassword 现在使用的密码
     * @param string $newPassword 新密码
     *
     * @return boolean
     *
     * @access public
     */
    function changePassword($username, $oldPassword, $newPassword) {
        return $this->_tbMembers->changePassword($username, $oldPassword, $newPassword);
    }
    
    /**
     * 获取指定 ID 的成员信息
     *
     * @param int $memberId
     * @param boolean $withAssoc 指示是否获取产品的关联信息
     *
     * @return array
     */
    function getMember($memberId, $withAssoc = false) {
        $link =& $this->_tbMembers->getLink($this->_tbMembers->rolesField);
        $link->enabled = $withAssoc;
        
        return $this->_tbMembers->find((int)$memberId);
    }

    /**
     * 更新成员信息
     *
     * @param array $member
     *
     * @return boolean
     */
    function updateMember($member) {
        $memberkey = $this->_tbMembers->primaryKey;
        if (isset($member[$memberkey]) && (int)$member[$memberkey] == 0) {
            unset($member[$memberkey]);
        }
        
        // 更新角色信息
        $link =& $this->_tbMembers->getLink($this->_tbMembers->rolesField);
        $link->enabled = true;

        return $this->_tbMembers->save($member);
    }
    
    /**
     * 创建新成员
     *
     * @param array $member
     *
     * @return boolean
     */
    function createMember($member) {
        $memberkey = $this->_tbMembers->primaryKey;
        if (isset($member[$memberkey]) && (int)$member[$memberkey] == 0) {
            unset($member[$memberkey]);
        }
        
        // 更新角色信息
        $link =& $this->_tbMembers->getLink($this->_tbMembers->rolesField);
        $link->enabled = true;

        $member['nickname'] = $member['username'];
        $member['password'] = 'zhou';
        return $this->_tbMembers->create($member);
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
        // 同时删除角色，加班记录，帖子记录
        $link =& $this->_tbMembers->getLink($this->_tbMembers->rolesField);
        $link->enabled = true;

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
