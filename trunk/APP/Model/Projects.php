<?php

/**
 * Model_Projects 提供项目信息的操作
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Model_Projects
{
    /**
     * 提供项目信息数据库访问服务的对象
     *
     * @var Table_Projects
     */
    var $_tbProjects;
    
    /**
     * 构造函数
     *
     * @return Model_Projects
     */
    function Model_Projects() {
        $this->_tbProjects =& FLEA::getSingleton('Table_Projects');
    }

    /**
     * 获取指定 ID 的project信息
     *
     * @param int $projectId
     *
     * @return array
     */
    function getProject($projectId) {

        return $this->_tbProjects->find((int)$projectId);
    }

    /**
     * 保存项目信息
     *
     * @param array $project
     *
     * @return boolean
     */
    function savePost($project) {
        if (isset($project['project_id']) && (int)$project['project_id'] == 0) {
            unset($project['project_id']);
        }

        return $this->_tbProjects->save($project);
    }

    /**
     * 删除指定的项目信息
     *
     * @param int $projectId
     *
     * @return boolean
     */
    function removePost($projectId) {
        $projectId = (int)$projectId;

        $project = $this->_tbProjects->find($projectId);
        if (!$project) {
            FLEA::loadClass('Exception_DataNotFound');
            __THROW(new Exception_DataNotFound($projectId));
            return false;
        }

        return $this->_tbProjects->removeByPkv($projectId);
    }

    /**
     * 返回 Table_Projects 对象
     *
     * @return Table_Projects
     */
    function & getTable() {
        return $this->_tbProjects;
    }
}
