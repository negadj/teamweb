<?php

// {{{ includes
FLEA::loadClass('FLEA_Rbac_UsersManager');
// }}}

/**
 * Table_SysUsers 封装了对系统用户信息的数据库访问，同时还负责取出用户的角色信息
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Table_SysUsers extends FLEA_Rbac_UsersManager
{    
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'admin';

    /**
     * 主键字段名
     *
     * @var string
     */
    var $primaryKey = 'admin_id';
}

?>