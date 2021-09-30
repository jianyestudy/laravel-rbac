<?php

namespace QCS\LaravelRbac\Interfaces;
/**
 * User: Edward Yu
 * Date: 2021/9/24
 */
interface RoleStatusInterface
{
        public const ENABLE   = 0;
        public const DISABLED = 1;

        public const MSG = [
          self::ENABLE   => '角色已启用',
          self::DISABLED => '角色已禁用'
        ];
}
