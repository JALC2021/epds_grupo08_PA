<div class="slider">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){  
            $(".foto1").css('display','none');
            $(".foto2").css('display','none');
            $(".foto3").css('display','none');
        var tiempo_inicio_anim = 0;  
        var tiempo_entre_img = 5000;  
        var tiempo_fade = 1500;  
        $(".foto1").show();
        function animacion_simple() {  
      
            // Mostramos la foto 1  
            $(".foto1").fadeIn(tiempo_fade); 
      
            // Cuando pasen otros 5000 milisegundos, ocultamos la foto 1 y mostramos la foto 2  
            setTimeout(function() {  
                // Ocultamos la foto 1  
                $(".foto1").hide();  
                // Mostramos la foto 2  
                $(".foto2").fadeIn(tiempo_fade);  
            }, tiempo_entre_img);  
      
            // Cuando pasen otros 5000 milisegundos, ocultamos la foto 2 y mostramos la foto 3  
            setTimeout(function() {  
                // Ocultamos la foto 2  
                $(".foto2").hide();  
                // Mostramos la foto 3  
                $(".foto3").fadeIn(tiempo_fade);  
            }, tiempo_entre_img*2);  
      
            // Cuando pasen otros 5000 milisegundos, ocultamos la foto 3 y volvemos a iniciar la animación  
            setTimeout(function() {  
                // Ocultamos la foto 3  
                $(".foto3").hide();  
                // Iniciamos otra vez la animación  
                animacion_simple();  
            }, tiempo_entre_img*3);  
      
        }  
      
        //Empezamos la animación a los 0 milisegundos  
        setTimeout(function() {  
            animacion_simple();  
        }, tiempo_inicio_anim);  
      
    });  
    </script> 
    <ol>
        <li><figure>
                <a href="detallarlibro.php?id=22"><img src="imagenes/slider1.png" alt="" class="foto1"/></a>
            </figure>
        </li>
        <li><figure>
                <a href="detallarlibro.php?id=21"><img src="imagenes/slider2.png" alt="" class="foto2"/></a>
            </figure>
        </li>
        <li><figure>
                <a href="ebooks.php"><img src="imagenes/slider3.png" alt="" class="foto3"/></a>
            </figure>
        </li>
    </ol>
</div>