<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css" />
        <title>EJERCICIO 1-EPD3</title>
    </head>
    <body>

        <?php

        function esBisiesto($anio) { //Función que devuelve si el año es bisiesto o no
            $salida = 0;

            if ($anio % 4 == 0 and $anio % 100 != 0 || $anio % 400 == 0) { //si cumple la condición de año bisiesto, salida devolverá 1
                $salida = 1;
            }
            return $salida;
        }

        function validaFecha($vector) { //Función que valida si la fecha introducida es correcta
            
            if ($vector[0] < 999 || $vector[0] > 9999) { //si el año no cumple esos límites, se informa del error
                $salida = '<span>El año introducido no es correcto. El año debe tener 4 dígitos</span>';
           
                } elseif ($vector[2] < 1 || $vector[2] > 31) {//si el día no cumple esos límites, se informa del error
                $salida = '<span>El número de días introducido no es correcto. El día debe estar comprendido entre 1 y 31</span>';
            
                
            } elseif ($vector[1] < 1 || $vector[1] > 12) {//si el mes no cumple esos límites, se informa del error
                $salida = '<span>El número del mes introducido no es correcto. El mes debe estar comprendido entre 1 y 12</span>';
            
                
            } else { //si la fecha es correcta, se evalúa el número del mes, para contemplar los días exactos que tiene cada mes
                switch ($vector[1]) {
                    case 1:
                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;

                    case 2:
                        if (esBisiesto($vector[0]) == 1) {//en el caso de febrero se tiene en cuenta la posibilidad de que el año introducido sea bisiesto, y por tanto existen dos casos. 
                            if ($vector[2] >= 1 and $vector[2] <= 29) {//si el año es bisiesto tendrá 29 días
                                $salida = 1;
                            }
                        } elseif ($vector[2] >= 1 and $vector[2] <= 28) {//si el año no es bisiesto tendrá 28 días
                            $salida = 1;
                        }
                        break;

                    case 3:

                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;
                    case 4:

                        if ($vector[2] >= 1 and $vector[2] <= 30) {
                            $salida = 1;
                        }
                        break;
                    case 5:

                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;
                    case 6:

                        if ($vector[2] >= 1 and $vector[2] <= 30) {
                            $salida = 1;
                        }
                        break;
                    case 7:

                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;
                    case 8:

                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;
                    case 9:

                        if ($vector[2] >= 1 and $vector[2] <= 30) {
                            $salida = 1;
                        }
                        break;
                    case 10:

                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;
                    case 11:

                        if ($vector[2] >= 1 and $vector[2] <= 30) {
                            $salida = 1;
                        }
                        break;
                    case 12:

                        if ($vector[2] >= 1 and $vector[2] <= 31) {
                            $salida = 1;
                        }
                        break;
                }
            }

            return $salida;//devuelve 1 en caso de que el número del mes sea correcto, o un error específico si la fecha no es correcta
        }

        function sumar($numDias, $fecha) { //Función que suma el número de días recibido por parámetro a la fecha recibida por parámetro
            $vector = explode('-', $fecha); //se separa la cadena recibida por el carácter -
            $salida = validaFecha($vector); //se comprueba que la fecha sea correcta y se guarda por si ha dado error, devolverlo

            $fechaValida = validaFecha($vector); //guardamos la comprobación de fecha, en otra variable para evaluar los días de cada mes y ver si necesitamos cambiar de mes al hacer la suma
            if ($fechaValida == 1) { //si la fecha es válida, procedemos a la suma

                $resSuma = $vector[2] + $numDias; //al día de la fecha, le sumamos el numero de días recibido como argumento
                $salida = $vector[0] . '-' . $vector[1] . '-' . $resSuma; //devolvemos la nueva fecha en un formato correcto

                if ($vector[1] == 4 || $vector[1] == 6 || $vector[1] == 9 || $vector[1] == 11) { //meses que tienen 30 días
                    if ($resSuma > 30) { //si la suma supera los 30 días del mes
                        $diaActual = 30 - $resSuma; //guardamos el número de días sobrantes, que será el día actual de la fecha haciendo el cambio de mes
                        $salida = $vector[0] . '-' . ($vector[1] + 1) . '-' . $diaActual; //cambio de mes
                    }
                } elseif ($vector[1] == 2) { //caso especial de febrero
                    if (esBisiesto($vector[0]) == 1 and $resSuma > 29) { //si tiene 29 dias a causa de que el año sea bisiesto
                        $diaActual = 29 - $resSuma;
                        $salida = $vector[0] . '-' . ($vector[1] + 1) . '-' . $diaActual; //cambio de mes
                    } elseif (esBisiesto($vector[0]) == 0 and $resSuma > 28) { //si tiene 28 días porque el año no es bisiesto
                        $diaActual = 28 - $resSuma;
                        $salida = $vector[0] . '-' . ($vector[1] + 1) . '-' . $diaActual; //cambio de mes
                    }
                } else {
                    if ($resSuma > 31) { //meses que tienen 31 días
                        $diaActual = 31 - $resSuma;
                        $salida = $vector[0] . '-' . ($vector[1] + 1) . '-' . $diaActual; //cambio de mes
                    }
                }
            }
            return $salida;
        }

        //Ejemplos de entradas y salidas

        echo '<span id=enunciado>Ejemplo 1: Fecha introducida: 2015-10-31 Número de días: 4 <br /></span>';
        $fecha1 = date('2015-10-31');
        echo sumar(4, $fecha1) . '<br /> <br />';

        echo '<span id=enunciado>Ejemplo 2: Fecha introducida: 1795-0-27 Número de días: 7 <br /></span>';
        $fecha2 = date('1795-0-27');
        echo sumar(7, $fecha2) . '<br /> <br />';

        echo '<span id=enunciado>Ejemplo 3: Fecha introducida: 2020-2-28 Número de días: 2 <br />Notar que 2020 es un año bisiesto, por tanto, febrero tendrá ese año 29 días <br /></span>';
        $fecha3 = date('2020-2-28');
        echo sumar(2, $fecha3) . '<br /> <br />';

        echo '<span id=enunciado>Ejemplo 4: Fecha introducida: 2014-2-28 Número de días: 8 <br />Notar que 2014 no es un año bisiesto, por tanto, febrero tuvo ese año 28 días <br /></span>';
        $fecha4 = date('2014-2-28');
        echo sumar(8, $fecha4) . '<br /> <br />';

        echo '<span id=enunciado>Ejemplo 5: Fecha introducida: 1991-5-33 Número de días: 1 <br /></span>';
        $fecha5 = date('1991-5-33');
        echo sumar(1, $fecha5) . '<br /> <br />';

        echo '<span id=enunciado>Ejemplo 6: Fecha introducida: 1800-9-27 Número de días: 3 <br /></span>';
        $fecha6 = date('1800-9-27');
        echo sumar(3, $fecha6) . '<br /> <br />';

        echo '<span id=enunciado>Ejemplo 7: Fecha introducida: 17955-1-2 Número de días: 5 <br /></span>';
        $fecha7 = date('17955-1-2');
        echo sumar(5, $fecha7) . '<br /> <br />';
        ?>
    </body>
</html>
