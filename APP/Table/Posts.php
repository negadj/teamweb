<?php

// {{{ includes
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_Posts 贴吧数据表访问服务
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Table_Posts extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名
     *
     * @var string
     */
    var $tableName = 'posts';

    /**
     * 数据表主键
     *
     * @var string
     */
    var $primaryKey = 'post_id';
}

?>
