<?php

/**
 * 定义所有控制器的访问控制表
 *
 * @package OfficeBoard
 * @subpackage ACT
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-09-19
 */

return array(
    /**
     * ZobLogin 控制器
     */
    'ZobLogin' => array(
        'allow' => RBAC_EVERYONE,
    ),

    /**
     * ZobBase 控制器
     */
    'ZobBase' => array(
       'deny' => RBAC_EVERYONE,
    ),

    /**
     * ZobHome 控制器
     */
    'ZobHome' => array(
        'allow' => RBAC_EVERYONE,
    ),
    
    /**
     * ZobPost 控制器
     */
    'ZobPost' => array(
        'allow' => RBAC_HAS_ROLE,
    ),
    
    /**
     * ZobAdmin 控制器
     */
    'ZobAdmin' => array(
        'allow' => RBAC_HAS_ROLE,
    ),
    
    /**
     * ZobMember 控制器
     */
    'ZobMember' => array(
        'allow' => RBAC_HAS_ROLE,
    ),
);

?>
