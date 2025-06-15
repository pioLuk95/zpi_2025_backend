<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    public static function INTERNIST(): string
    {
        return 'internist';
    }

    public static function SPECIALIST(): string
    {
        return 'specialist';
    }

    public static function REHABILITATOR(): string
    {
        return 'rehabilitator';
    }

    public static function NURSE(): string
    {
        return 'nurse';
    }

    public static function DOCTOR(): string
    {
        return 'doctor';
    }
}