<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Consultar Carrito</title>
        <?php
        include('./includes/cabecera.php');
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>
            <div class="ayuda">            
                <img src='imagenes/ayuda.png' alt='ayuda' class='ayuda1'/>                
                <h2>Ayuda</h2>
                <h4>&iquest;Qu&eacute; debo hacer si mi pedido ha llegado da&ntilde;ado en el transporte?</h4>

                <p>Es muy importante que al recibir tu pedido compruebes en ese momento que el embalaje se encuentra en perfectas condiciones. Si al momento de recibir tu pedido detectas que el envoltorio o la caja est&aacute;n da&ntilde;ados, debes rechazar la entrega del pedido, notific&aacute;ndolo en el albar&aacute;n de entrega del transportista, indicando claramente el motivo del rechazo.</p>

                <p>Si por el contrario, dentro de los 14 d&iacute;as siguientes a la entrega, detectas un da&ntilde;o en origen, el producto es defectuoso o no es conforme con lo pedido, puedes acudir a cualquier centro Media Markt o en su defecto solicitar el cambio del mismo.</p>
                <h4>&iquest;Qu&eacute; debo hacer si he recibido un producto err&oacute;neo?</h4>

                <p<Si has recibido un producto err&oacute;neo, deber&aacute;s ponerte en contacto con nosotros a trav&eacute;s del formulario de contacto que podr&aacute;s encontrar en el apartado de Contacto/Ayuda o bien a trav&eacute;s del tel&eacute;fono 902 102 573, en horario de lunes a viernes de 9:00 a 22:00 horas; s&aacute;bados, domingos y festivos de apertura de 9:00 a 20:00 horas.</p>

                <p>Un servicio de mensajer&iacute;a pasar&aacute; a recoger el producto en tu domicilio. &eacute;ste ser&aacute; llevado hasta nuestras instalaciones y, una vez comprobado el error, el producto nuevo te ser&aacute; entregado en tu domicilio.</p>
                <h4>&iquest;Por qu&eacute; no he recibido mi pedido si el plazo de entrega aproximado ya ha pasado?</h4>

                <p>Los per&iacute;odos de entrega var&iacute;an entre 24 y 72 horas para paqueter&iacute;a y de 2 a 4 d&iacute;as para grandes dimensiones dependiendo del servicio contratado. En caso de haber excedido el plazo de entrega esperado, puedes ponerte en contacto con nuestro servicio de atenci&oacute;n al cliente a trav&eacute;s del formulario que encontrar&aacute;s en el apartado de Contacto/Ayuda o bien a trav&eacute;s de nuestro tel&eacute;fono 902 102 573, en horario de lunes a viernes de 9:00 a 22:00 horas; s&aacute;bados, domingos y festivos de apertura de 9:00 a 20:00 horas, donde te ampliar&aacute;n mayor informaci&oacute;n sobre tu pedido.</p>
                <p>Si tienes cualquier otra duda puedes ponerte en contacto con nosotros desde el area <a href='contacto.php'><strong>Contacto</strong></a></p>
                <img src='imagenes/ayuda2.jpg' alt='ayuda' class='ayuda2'/>  
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?>
        </div>
    </body>
</html>