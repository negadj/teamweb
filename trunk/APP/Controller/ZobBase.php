<?php

/**
 * Controller_ZobBase 是后台控制器的基类，提供一些公共方法
 *
 * @package OfficeBoard
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-09-19
 */
class Controller_ZobBase extends FLEA_Controller_Action
{
    /**
     * 构造函数
     *
     * 负责根据用户的 session 设置载入语言文件
     *
     * @return Controller_OfficeBase
     */
    function Controller_ZobBase() {
        if (isset($_SESSION['LANG'])) {
            $lang = $_SESSION['LANG'];
            $languages = FLEA::getAppInf('languages');
            if (in_array($lang, $languages, true)) {
                FLEA::setAppInf('defaultLanguage', $lang);
            }
        }
        load_language('ui, exception');
    }

    /**
     * 根据数据表的元数据返回一个数组，这个数组包含所有需要初始化的数据，可以用于界面显示
     *
     * @param array $meta
     *
     * @return array
     */
    function _prepareData(& $meta) {
        $data = array();
        foreach ($meta as $m) {
            if (isset($_POST[$m['name']])) {
                $data[$m['name']] = $_POST[$m['name']];
            } else {
                if (isset($m['defaultValue'])) {
                    $data[$m['name']] = $m['defaultValue'];
                } else {
                    $data[$m['name']] = null;
                }
            }
        }
        return $data;
    }

    /**
     * 返回用 _setBack() 设置的 URL
     */
    function _goBack() {
        $url = $this->_getBack();
        unset($_SESSION['BACKURL']);
        redirect($url);
    }

    /**
     * 设置返回点 URL，稍后可以用 _goBack() 返回
     */
    function _setBack() {
        $_SESSION['BACKURL'] = encode_url_args($_GET);
    }

    /**
     * 获取返回点 URL
     *
     * @return string
     */
    function _getBack() {
        if (isset($_SESSION['BACKURL'])) {
            $url = $this->rawurl($_SESSION['BACKURL']);
        } else {
            $url = $this->_url();
        }
        return $url;
    }

    /**
     * 直接提供查询字符串，生成 URL 地址
     *
     * @param string $queryString
     *
     * @return string
     */
    function rawurl($queryString) {
    	if (substr($queryString, 0, 1) == '?') {
    		$queryString = substr($queryString, 1);
    	}
    	return $_SERVER['SCRIPT_NAME'] . '?' . $queryString;
    }
}
