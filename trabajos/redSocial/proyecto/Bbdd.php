<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bbdd
 *
 * @author er_jo
 */
//Creacion de la conexion de la base de datos.
function conectarbd() {
    $link = mysqli_connect("localhost", "root", "", "proyecto");
    if (!$link) {
        die(' No puedo conectar: ' . mysqli_error($link));
    }
    return $link;
}

function login($nombre_usuario, $pwd) {
    $link = conectarbd();
    $encontrado = false;
    $result = mysqli_query($link, "SELECT * FROM `usuario` WHERE `nombre_usuario` = '$nombre_usuario'");
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        $row = mysqli_fetch_array($result);
        if (md5($pwd) === ($row['pwd'])) {
            session_start();
            mysqli_close($link);
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['usuario'] = $row['nombre_usuario'];
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $encontrado = true;
        }
    }
    return $encontrado;
}

function existe($nombre_usuario, $email, $telefono) {
    $link = conectarbd();
    $encontrado = false;
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `usuario` WHERE `nombre_usuario` = '$nombre_usuario' and "
                . "`email`='$email' and `telefono`='$telefono'");
        if ($result == null) {
            $encontrado = true;
        }
    }
    mysqli_close($link);
    return $encontrado;
}

function registro($nombre, $apellido1, $apellido2, $email, $telefono, $pwd, $usuario, $conf_pwd) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        if (!existe($usuario, $email, $telefono) && $pwd == $conf_pwd) {
            $pwd = md5($conf_pwd);
            $result = mysqli_query($link, "INSERT INTO `usuario`(`nombre`, `apellido1`, "
                    . "`apellido2`, `email`, `pwd`, `nombre_usuario`, `telefono`) "
                    . "VALUES ('$nombre','$apellido1','$apellido2','$email','$pwd','$usuario','$telefono')");
            if (!$result) {
                die("Error: " . mysqli_error($link));
            } else {
                session_start();
                $result1 = mysqli_query($link, "SELECT MAX(nombre) from `usuario`");
                $row1 = mysqli_fetch_array($result1);
                $_SESSION['nombre'] = $row1['nombre'];
                $result2 = mysqli_query($link, "SELECT MAX(nombre_usuario) from `usuario`");
                $row2 = mysqli_fetch_array($result2);
                $_SESSION['usuario'] = $row2['nombre_usuario'];
                $result3 = mysqli_query($link, "SELECT MAX(id_usuario) from `usuario`");
                $row3 = mysqli_fetch_array($result3);
                $_SESSION['id_usuario'] = $row3['id_usuario'];
            }
        }
        mysqli_close($link);
    }
}

function consultar_usuario($nombre_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `usuario` WHERE `nombre_usuario`='$nombre_usuario'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function crear_publicacion($descripcion, $ciudad, $direccion, $hora, $titulo, $fecha_evento, $id_usuario, $nombre_usuario, $tipo) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $fecha_creacion = date("Y-m-d");
        $estado = 0;
        $result = mysqli_query($link, "INSERT INTO `publicacion`(`fecha_creacion`, "
                . "`descripcion`, `ciudad`, `direccion`, `hora`, `estado`, `titulo`, "
                . "`fecha_evento`, `id_usuario`,`nombre_usuario`,`tipo`) VALUES ('$fecha_creacion','$descripcion','$ciudad',"
                . "'$direccion','$hora','$estado','$titulo','$fecha_evento','$id_usuario','$nombre_usuario','$tipo')");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    mysqli_close($link);
}

function consultar_publicacion_publica() {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `publicacion` WHERE `tipo` = 0");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function consultar_publicacion_publica_y_privada() {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `publicacion` WHERE `tipo` = 0 OR `tipo` = 1");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function consultar_publicacion_con_id_publicacion($id_pub) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `publicacion` WHERE `id_pub` = '$id_pub'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function crear_grupo($titulo, $descripcion, $tipo, $id_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "INSERT INTO `grupo`(`titulo`, `descripcion`, "
                . "`tipo`, `id_usuario`) VALUES ('$titulo','$descripcion','$tipo','$id_usuario')");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    mysqli_close($link);
}

function consultar_grupo($tipo) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `grupo` WHERE `tipo`='$tipo'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function crear_mensaje_en_grupo($contenido, $id_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "INSERT INTO `mensaje`(`contenido`, `fecha`, "
                . "`id_usuario`) VALUES ('$contenido',GETDATE(),'$id_usuario')");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    mysqli_close($link);
}

function crear_publicacion_en_grupo($descripcion, $ciudad, $direccion, $hora, $estado, $titulo, $fecha_evento, $id_usuario, $tipo, $id_grupo) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        crear_publicacion($descripcion, $ciudad, $direccion, $hora, $estado, $titulo, $fecha_evento, $id_usuario, $tipo);
        $id_pub = mysqli_query($link, "SELECT MAX(id_pub) FROM `publicacion`");
        if (!$id_pub) {
            die("Error: " . mysqli_error($link));
        } else {
            $result = mysqli_query($link, "INSERT INTO `grupo`(`id_pub`) VALUES () WHERE `id_grupo`='$id_grupo'");
            if (!$result) {
                die("Error: " . mysqli_error($link));
            } else {
                mysqli_close($link);
            }
        }
    }
}

function consultar_mis_mensajes($id_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `mensaje` WHERE `id_usuario_destino` = '$id_usuario'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function unirse_grupo($id_grupo, $id_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "UPDATE `grupo` SET `id_usuario`='$id_usuario' WHERE `id_grupo`='$id_grupo'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    mysqli_close($link);
}

function crear_mensaje($contenido, $id_usuario_origen, $id_usuario_destino, $id_pub, $nombre_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $fecha_creacion = date("Y-m-d");
        $result = mysqli_query($link, "INSERT INTO `mensaje`(`contenido`, `fecha`, `id_usuario_origen`, `id_pub`, `id_usuario_destino`, `nombre_usuario`) VALUES ('$contenido','$fecha_creacion','$id_usuario_origen','$id_pub','$id_usuario_destino','$nombre_usuario')");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    mysqli_close($link);
}

function consultar_titulo_publicacion($id_pub) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT `titulo` FROM `publicacion` WHERE `id_pub` ='$id_pub'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function consultar_imagen_usuario($id_usuario) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * FROM `usuario` WHERE `id_usuario`='$id_usuario'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

function crear_solicitud($id_usuario_destino, $id_usuario_origen, $id_grupo) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "INSERT INTO `solicitud`(`id_usuario_destino`, `id_usuario_origen`,`id_grupo`) "
                . "VALUES ('$id_usuario_destino','$id_usuario_origen','$id_grupo')");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    mysqli_close($link);
}

function consultar_solicitud($id_usuario_destino) {
    $link = conectarbd();
    if (!$link) {
        die("Error: " . mysqli_error($link));
    } else {
        $result = mysqli_query($link, "SELECT * from `solicitud` "
                . "WHERE `id_usuario_destino`='$id_usuario_destino'");
        if (!$result) {
            die("Error: " . mysqli_error($link));
        }
    }
    return $result;
    mysqli_close($link);
}

?>