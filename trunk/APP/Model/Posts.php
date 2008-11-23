<?php

/**
 * Model_Posts 提供贴吧信息的操作
 *
 * @package TeamWeb
 * @subpackage Model
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-22
 */
class Model_Posts
{
    /**
     * 提供贴吧信息数据库访问服务的对象
     *
     * @var Table_Posts
     */
    var $_tbPosts;
    
    /**
     * 构造函数
     *
     * @return Model_Posts
     */
    function Model_Posts() {
        $this->_tbPosts =& FLEA::getSingleton('Table_Posts');
    }

    /**
     * 获取指定 ID 的post信息
     *
     * @param int $postId
     *
     * @return array
     */
    function getPost($postId) {

        return $this->_tbPosts->find((int)$postId);
    }

    /**
     * 保存贴吧信息
     *
     * @param array $post
     *
     * @return boolean
     */
    function savePost($post) {
        if (isset($post['post_id']) && (int)$post['post_id'] == 0) {
            unset($post['post_id']);
        }

        return $this->_tbPosts->save($post);
    }

    /**
     * 删除指定的贴吧信息
     *
     * @param int $postId
     *
     * @return boolean
     */
    function removePost($postId) {
        $postId = (int)$postId;

        $post = $this->_tbPosts->find($postId);
        if (!$post) {
            FLEA::loadClass('Exception_DataNotFound');
            __THROW(new Exception_DataNotFound($postId));
            return false;
        }

        return $this->_tbPosts->removeByPkv($postId);
    }

    /**
     * 返回 Table_Posts 对象
     *
     * @return Table_Posts
     */
    function & getTable() {
        return $this->_tbPosts;
    }
}
