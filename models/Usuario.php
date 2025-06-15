<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $columnasDB = [
        'id_roles',
        'f_perfil',
        'userName',
        'password',
        'email',
        'confirmado',
        'token',
        'Creado_Fecha',
        'Cambiado_Fecha',
        'intentos_fallidos'
    ];
    protected static $id = 'idusuario';
    public $idusuario;
    public $id_roles;
    public $f_perfil;
    public $userName;
    public $intentos_fallidos;
    public $password;
    public $email;
    public $confirmado;
    public $token;
    public $Creado_Fecha;
    public $Cambiado_Fecha;
    public function __construct($args = [])
    {
        $this->idusuario = $args['idusuario'] ?? null;
        $this->id_roles = $args['id_roles'] ?? '';
        $this->f_perfil = $args['f_perfil'] ?? 'f_perfil_deaulft.png';
        $this->userName = $args['userName'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->Creado_Fecha = date('Y/m/d H:i:s');
        $this->Cambiado_Fecha = date('Y/m/d H:i:s');
        $this->intentos_fallidos = $args['intentos_fallidos'] ?? '0';
    }
    public static function filtrarUsuarios($rol = '', $busqueda = '')
    {
        $condiciones = ["eliminado = 0"]; // Solo usuarios no eliminados

        if ($rol !== '') {
            $rol = self::$db->real_escape_string($rol);
            $condiciones[] = "id_roles = '$rol'";
        }

        if ($busqueda !== '') {
            $busqueda = self::$db->real_escape_string($busqueda);
            $condiciones[] = "(userName LIKE '%$busqueda%' OR email LIKE '%$busqueda%')";
        }

        $where = 'WHERE ' . implode(' AND ', $condiciones);
        $query = "SELECT * FROM " . static::$tabla . " $where";

        return self::consultarSQL($query);
    }

    public function validarNuevaCuenta()
    {
        $alertas = [];

        if (!$this->userName) {
            $alertas['error'][] = 'El nombre de usuario es obligatorio';
        }

        if (!$this->email) {
            $alertas['error'][] = 'El correo electrónico es obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $alertas['error'][] = 'El correo electrónico no es válido';
        }

        if (!$this->password || strlen($this->password) < 6) {
            $alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }

        return $alertas;
    }

    public function setImagen($imagen): void
    {
        if (!is_null($this->f_perfil)) {
            $this->delete_image();
        }
        if ($imagen) {
            $this->f_perfil = $imagen;
        }
    }
    //Eliminar archivos
    public function delete_image()
    {
        //comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETAS_IMAGENES_PERFILES . "/" . $this->f_perfil);

        if ($existeArchivo) {
            //borrar el archivo
            chmod(CARPETAS_IMAGENES_PERFILES, 0755);
            unlink(CARPETAS_IMAGENES_PERFILES . "/" . $this->f_perfil);
        }
    }


    public function validarUsuario()
    {
        if (!$this->userName) {
            self::$alertas['error'][] = 'El nombre de usuario es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es Obligatoria';
        }
        if (
            strlen($this->password) < 8 ||
            !preg_match('/\d/', $this->password) ||                    // Al menos un número
            !preg_match('/[^a-zA-Z0-9]/', $this->password)             // Al menos un carácter especial
        ) {
            self::$alertas['error'][] = 'La contraseña debe tener al menos 8 caracteres, incluir un número y un carácter especial.';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es válido';
        }
        if (!$this->id_roles) {
            self::$alertas['error'][] = 'El rol usuario es Obligatorio';
        }
        return self::$alertas;
    }
    public function validarLogin(): array
    {
        if (!$this->email && !$this->userName) {
            self::$alertas['error'][] = 'Debes ingresar un Email o un Nombre de Usuario.';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria.';
        }

        return self::$alertas;
    }
    public function validarEmail(): array
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        return self::$alertas;
    }
    public function validarPassword(): array
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }
    public function existeUsuario(): mixed
    {
        $query = " SELECT * FROM " . self::$tabla . " WHERE userName = '" . $this->userName . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El Usuario ya esta registrado';
        }

        return $resultado;
    }
    public function existeEmail(): mixed
    {
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El Email ya esta registrado';
        }

        return $resultado;
    }
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(): void
    {
        $this->token = uniqid();
    }
    public function comprobarPassword($password)
    {
        $resultado = password_verify($password, $this->password);

        if (!$resultado) {
            self::$alertas['error'][] = 'Password Incorrecto';
        } else {
            return true;
        }
    }
    public function comprobarVerificado($password)
    {
        $resultado = password_verify($password, $this->password);

        if (!$this->confirmado) {
            self::$alertas['error'][] = 'Tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
    public function comprobarPasswordAndVerificado($password)
    {
        if ($this->comprobarPassword($password) || $this->comprobarVerificado($password)) {
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
    public static function obtenerIdsAdministradores()
    {
        $query = "SELECT idusuario FROM usuario WHERE id_roles = 1 AND eliminado = 0";
        $resultado = self::$db->query($query);

        $ids = [];
        while ($row = $resultado->fetch_assoc()) {
            $ids[] = $row['idusuario'];
        }

        return $ids;
    }
    public static function obtenerIdsVendedores()
    {
        $query = "SELECT idusuario FROM usuario WHERE id_roles = 2 AND eliminado = 0";
        $resultado = self::$db->query($query);

        $ids = [];
        while ($row = $resultado->fetch_assoc()) {
            $ids[] = $row['idusuario'];
        }

        return $ids;
    }
    public static function obtenerPorRol($rol)
    {
        $rol = self::$db->real_escape_string($rol);
        $sql = "SELECT * FROM usuario WHERE id_roles = '$rol'";
        $resultado = self::$db->query($sql);

        $usuarios = [];
        while ($row = $resultado->fetch_assoc()) {
            $usuarios[] = (object) $row;
        }

        return $usuarios;
    }

}
