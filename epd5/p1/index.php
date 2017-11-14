<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Epd_5_p1</title>
    </head>
    <body>
        <p>Cree un sistema, compuesto por varias páginas PHP, que permita gestionar vuelos y destinos de aerolíneas.
            La primera página del sistema permitirá dar de alta una aerolínea y sus destinos. En ella se pedirá al usuario el nombre de la
            aerolínea y el número de destinos en los que opera. Al enviar esta información, se proporcionará al usuario un nuevo formulario en
            el que se podrán indicar, mediante listas desplegables (campos select), las ciudades de cada uno de los destinos. Considere para
            ello un vector con el siguiente repertorio de ciudades posibles: Roma, Paris, Londres, Dublin, Sevilla, Madrid, Barcelona y
            Amsterdam. Este repertorio de ciudades deberá ser leído de un archivo de texto que contendrá dichas ciudades separadas por
            comas (,). Recogidos todos estos datos, se escribirán en dos archivos. El primero almacenará dos campos: un código autonumérico
            y el nombre de cada aerolínea. El código autonumérico deberá ser generado a partir del siguiente número al máximo de los
            almacenados en el fichero. El segundo almacenará los nombres de los destinos de cada aerolínea (en forma de pares compuestos
            por el código numérico de la aerolínea y el nombre del destino). Estos ficheros emplearán el formato CSV para representar los
            datos, usando un punto y coma (;) como separador entre campos.
        <p>La segunda página del sistema permitirá introducir los vuelos. Se mostrará un listado con las diferentes aerolíneas registradas en el
            sistema. Justo debajo de cada nombre de aerolínea, en la misma página, se mostrará una lista de botones de radio indicando los
            diferentes destinos en los que opera la aerolínea, para que el usuario seleccione la ciudad de origen del vuelo. El usuario
            seleccionará uno y pulsará el botón enviar. A continuación, se le mostrará al usuario una lista displegable con aquellos destinos
            para los que no se tiene ningún vuelo que lo conecte desde la ciudad origen seleccionada en el paso anterior (estos datos los
            podremos obtener del fichero que se describe a continuación), así como un cuadro de texto de tipo time para especificar la duración
            del vuelo (en horas y minutos). En caso de que todos los destinos de la aerolínea hayan sido ya conectados con el destino
            seleccionado en el primer paso, se mostrará un mensaje de error indicando tal eventualidad. Recogidos los datos, se guardarán en
            un archivo CSV de vuelos, donde se indique el código numérico de la aerolínea, el nombre del destino (ciudad) origen del vuelo, el
            nombre del destino final, así como las horas y minutos de duración del vuelo.</p>
        <p>Finalmente, una tercera página nos permitirá mostrar un informe de resumen de los destinos de una de las aerolíneas registradas
            en el sistema. Para ello, se ofrecerá una lista con botones de radio de cada una de las aerolíneas y, al enviar esta información, se
            ofrecerá el informe resumen indicando el nombre del destino, el número de vuelos (conexiones) que parten de él y el tiempo medio
            de vuelo hacia otros destinos. Esta tabla mostrará los destinos ordenados de forma descendente en función del número de
            conexiones.</p>
        <p>Cree una página principal que permita el acceso a cada una de las páginas descritas anteriormente.</p>
        <h2>Alta Aerol&iacute;nea</h2>
        <form method="post" action =altaAerolinea.php name="alta">
            Nombre: <input type="text" name="nombreAerolinea"><br />
            N&uacute;mero de Destinos: <input type="number" name="nDestinos" value="0" min="0" max="8"><br />
            <input type="submit" name="siguiente" value="Siguiente">
        </form>
    </body>
</html>
