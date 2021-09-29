<?php

namespace QCYX\LaravelRbac\Interfaces;
/**
 * User: Edward Yu
 * Date: 2021/9/24
 */
interface PermissionInterfaces
{
        public const MENU           = 1;
        public const DIRECTORY      = 2;
        public const BUTTON         = 3;

        public const UNHIDDEN      = 0;
        public const HIDDEN         = 1;

        public const TYPE_MSG = [
          self::MENU         => '菜单',
          self::DIRECTORY    => '目录',
          self::BUTTON       => '按钮'
        ];

        public const HIDDEN_MSG = [
          self::UNHIDDEN    => '显示',
          self::HIDDEN      => '隐藏'
        ];
}
