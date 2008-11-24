<?php

/**
 * Model_SysUsers 封装了对成员信息的所有操作
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Model_SysUsers
{
    /**
     * 提供成员信息数据库访问服务的对象
     *
     * @var Table_SysUsers
     */
    var $_tbSysUsers;

    /**
     * 构造函数
     *
     * @return Model_SysUsers
     */
    function Model_SysUsers() {
        $this->_tbSysUsers =& FLEA::getSingleton('Table_SysUsers');
    }
    
    /**
     * 根据用户名(登录名)查找用户
     * 
     * @return array 用户信息数组
     */ 
    function findByUsername($username) {
        return $this->_tbSysUsers->findByUsername($username);
    }
    
    /**
     * 检查用户的密码是否正确
     * 
     * @return bool
     */
    function checkPassword($cleartext, $cryptograph) {
        return $this->_tbSysUsers->checkPassword($cleartext, $cryptograph);
    }
    
    /**
     * 返回 Table_SysUsers 对象
     *
     * @return Table_SysUsers
     */
    function & getTable() {
        return $this->_tbSysUsers;
    }
}
