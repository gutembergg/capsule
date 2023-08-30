<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN = 'Super Admin';
    case TEACHER = 'teacher';
    case STUDENT = 'student';
}
