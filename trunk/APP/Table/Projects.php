<?php

// {{{ includes
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_Projects 项目数据表访问服务
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Table_Projects extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名
     *
     * @var string
     */
    var $tableName = 'projects';

    /**
     * 数据表主键
     *
     * @var string
     */
    var $primaryKey = 'project_id';
}

?>
