<?php

// {{{ includes
FLEA::loadClass('FLEA_Rbac_UsersManager');
// }}}

/**
 * Table_Members 封装了对系统用户信息的数据库访问，同时还负责取出用户的角色信息
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Table_Members extends FLEA_Rbac_UsersManager
{    
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'members';

    /**
     * 主键字段名
     *
     * @var string
     */
    var $primaryKey = 'member_id';
}

?>