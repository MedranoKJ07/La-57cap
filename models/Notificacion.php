<?php
namespace Model;

class Notificacion extends ActiveRecord
{
    protected static $tabla = 'notificacion';
    protected static $columnasDB = [
        'usuario_idusuario',
        'titulo',
        'descripcion',
        'creada_fecha'
    ];
    protected static $id = 'idnotificacion';
    public $idnotificacion;
    public $usuario_idusuario;
    public $titulo;
    public $descripcion;
    public $creada_fecha;
    public function __construct($args = [])
    {
        $this->idnotificacion = $args['idnotificacion'] ?? null;
        $this->usuario_idusuario = $args['usuario_idusuario'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->creada_fecha = date('Y/m/d H:i:s');
    }
    // 🔔 Método para crear notificación fácilmente
    public static function crearNotificacion($titulo, $descripcion, $usuario_id)
    {
        $noti = new self([
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'usuario_idusuario' => $usuario_id,
        ]);

        return $noti->crear();
    }

    // 🔍 Obtener todas las notificaciones visibles de un usuario
    public static function obtenerPorUsuario($idUsuario)
    {
        $idUsuario = self::$db->real_escape_string($idUsuario);

        $query = "SELECT * FROM notificacion 
                  WHERE usuario_idusuario = '$idUsuario' AND eliminado = 0 
                  ORDER BY creada_fecha DESC";

        return self::consultarSQL($query);
    }
    // 🔍 Obtener todas las notificaciones visibles de un usuario
    public static function obtenerPorUsuarioUltimas4($idUsuario)
    {
        $idUsuario = self::$db->real_escape_string($idUsuario);

        $query = "SELECT * FROM notificacion 
                  WHERE usuario_idusuario = '$idUsuario' AND eliminado = 0 
                  ORDER BY creada_fecha DESC LIMIT 4";

        return self::consultarSQL($query);
    }

    // 🗑️ Marcar como eliminada (no física)
    public static function eliminarLogicamente($idNoti)
    {
        $idNoti = self::$db->real_escape_string($idNoti);

        $query = "UPDATE notificacion SET eliminado = 1 WHERE idnotificacion = '$idNoti' LIMIT 1";
        return self::$db->query($query);
    }
    public static function obtenerPorUsuarioJson()
    {
        if (!isset($_SESSION['id'])) {
            echo json_encode([]);
            return;
        }

        $idUsuario = $_SESSION['id'];
        $notificaciones = Notificacion::obtenerPorUsuario($idUsuario);

        header('Content-Type: application/json');
        echo json_encode($notificaciones);
    }

}