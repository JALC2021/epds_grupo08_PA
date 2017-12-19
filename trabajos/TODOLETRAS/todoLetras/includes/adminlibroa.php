<div class="admin">
    <div class="padding-center">
    <?php
    if ($_SESSION['tipo'] == "admin") {
        ?>

        <p class="center"><strong>INSERTE LOS DATOS DEL NUEVO LIBRO:</strong></p>

        <form action="agregarlibroinsert.php" enctype="multipart/form-data" method="post" id="formulario" onsubmit="return comprobarlibro();">
            <table align="center">
                <tr>
                    <td><label>Titulo:</label></td>
                </tr>
                <tr>
                    <td><input type="text" size="40" name="titulo" id="titulo" onchange="validarTitulo(this)"/></td>
                <tr><td id='tituloError'></td></tr>
                </tr>
                <tr>
                    <td><label>Autor:</label></td>
                </tr>
                <tr>
                    <td><input type="text" size="40" name="autor" id="autor" onchange="validarAutor(this)"/></td>
                <tr><td id='autorError'></td></tr>
                </tr>
                <tr>
                    <td><label>Editorial:</label></td>
                </tr>
                <tr>
                    <td><input type="text" size="40" name="editorial" id="editorial" onchange="validarEditorial(this)"/></td>
                <tr><td id='editorialError'></td></tr>
                </tr>
                <tr>
                    <td><label>Genero:</label></td>
                </tr>
                <tr>
                    <td><select id='genero' name='genero'>
                    <optgroup label='Narrativo'>
                        <option value='Novela' selected='selected'>Novela</option>
                        <option value='Cuento'>Cuento</option>
                        <option value='Novela corta'>Novela corta</option>
                        <option value='Leyenda'>Leyenda</option>
                    </optgroup>
                    <optgroup label='Lirico'>
                        <option value='Egloga' selected='selected'>Egloga</option>
                        <option value='Elegia'>Elegia</option>
                        <option value='Himno'>Himno</option>
                        <option value='Opera'>Oda</option>
                        <option value='Satira'>Satira</option>
                        <option value='Epigrama'>Epigrama</option>
                        <option value='Madrigal'>Madrigal</option>
                    </optgroup>
                    <optgroup label='Epica'>
                        <option value='Epopeya' selected='selected'>Epopeya</option>
                        <option value='Poema epico'>Poema epico</option>
                        <option value='Cantar de gesta'>Cantar de gesta</option>
                        <option value='Romances'>Romances</option>
                    </optgroup>
                    <optgroup label='Dramatico'>
                        <option value='Tragedia' selected='selected'>Tragedia</option>
                        <option value='Drama'>Drama</option>
                        <option value='Comedia'>Comedia</option>
                    </optgroup>";
                    <optgroup label='Did&aacute;ctico'>
                        <option value='Tragedia' selected='selected'>Ensayo</option>
                        <option value='F&aacute;bula'>F&aacute;bula</option>
                        <option value='Ep&iacute;stola'>Ep&iacute;stola</option>
                        <option value='Di&aacute;logo'>Dialogo</option>
                    </optgroup>";
                    <optgroup label='Otros'>
                        <option value='otros' selected='selected'>Otros</option>
                    </optgroup>
                </select></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label>A&ntilde;o edici&oacute;n:</label></td>
                </tr>
                <tr>
                    <td><input type="text" size="4" name="edicion" id="edicion" onchange="validarEdicion(this)"/></td>
                <tr><td id='edicionError'></td></tr>
                </tr>
                <tr>
                    <td><label>ISBN:</label></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" name="isbn" id="isbn" onchange="validarIsbn(this)"/></td>
                <tr><td id='isbnError'></td></tr>
                </tr>
                <tr>
                    <td><label>Portada del libro:</label></td>
                </tr>
                <tr>
                    <td><input type="file" name="file" id="file" onchange="validarFile(this)"/></td>
                <tr><td id='fileError'></td></tr>
                </tr>
                <tr>
                    <td><label>Precio:</label></td>
                </tr>
                <tr>
                    <td><input type="text" size="5" name="precio" id="precio" onchange="validarPrecio(this)"/></td>
                <tr><td id='precioError'></td></tr>
                </tr>
                <tr>
                    <td><input type="submit" name="enviar" value='A&ntilde;adir' class="input-button"/></td>
                </tr>
            </table>
        </form>
    <p class="center"><a href="administracion.php">Volver a opciones</a></p>
        <?php
    } else {
        echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores pueden acceder a esta p&aacute;gina.</p>";
    }
    ?>
    </div>
</div>