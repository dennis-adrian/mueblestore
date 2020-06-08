<?php

namespace classes\ctrl_session;

class Ctrl_Sesion
{
    private static $login_usuario = "login_usuario";
    private static  $id_usuario = "id_usuario";
    private static $nombre_usuario = "nombre_usuario";

    public static function get_nombre_usuario()
    {
        return $_SESSION[Ctrl_Sesion::$nombre_usuario];
    }
    public static function get_id_usuario()
    {
        return $_SESSION[Ctrl_Sesion::$id_usuario];
    }
    static function get_login_usuario()
    {
        return $_SESSION[Ctrl_Sesion::$login_usuario];
    }
    static function activar_sesion()
    {
        try {
            @session_start();
        } catch (\Exception $e) {
        }
    }
    static function iniciar_sesion($login, $id_usuario, $nombre_usuario)
    {
        Ctrl_Sesion::activar_sesion();
        $_SESSION[Ctrl_Sesion::$login_usuario] = $login;
        $_SESSION[Ctrl_Sesion::$id_usuario] = $id_usuario;
        $_SESSION[Ctrl_Sesion::$nombre_usuario] = $nombre_usuario;
    }
    static function verificar_inicio_sesion()
    {
        Ctrl_Sesion::activar_sesion();
        if (isset($_SESSION[Ctrl_Sesion::$login_usuario]))
            return true;
        else
            header('location:../frmlogin.php?msg=no esta logueado!!!');
    }
    static function cerrar_sesion()
    {
        Ctrl_Sesion::activar_sesion();
        unset($_SESSION[Ctrl_Sesion::$login_usuario]);
        unset($_SESSION[Ctrl_Sesion::$id_usuario]);
        unset($_SESSION[Ctrl_Sesion::$nombre_usuario]);

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 65464, '/');
        }
        session_destroy();
        header('location:../frmlogin.php?msg=sesion cerrada correctamente!!!');
    }
}