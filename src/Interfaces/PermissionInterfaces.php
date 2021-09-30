<?php

namespace QCS\LaravelRbac\Interfaces;
/**
 * User: Edward Yu
 * Date: 2021/9/24
 */
interface PermissionInterfaces
{
        public const MENU           = 1;
        public const DIRECTORY      = 2;
        public const BUTTON         = 3;

        public const VISITABLE      = 0;
        public const HIDDEN         = 1;

        public const TYPE_MSG = [
          self::MENU         => '菜单',
          self::DIRECTORY    => '目录',
          self::BUTTON       => '按钮'
        ];

        public const HIDDEN_MSG = [
          self::VISITABLE    => '显示',
          self::HIDDEN      => '隐藏'
        ];
}
