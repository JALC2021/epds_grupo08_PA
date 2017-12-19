<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras</title>
        <?php
        include('./includes/cabecera.php');
        ?>
        <script src="js/comprobarregistro.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>

            <div class="registro">
                <form action="registrar.php" method="post" id="formulario" onsubmit="return comprobarregistro();">
                    <table align="center">
                        <tr>
                            <td><label>Usuario*:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="user" id="user" onchange="validarUsuario(this)"/></td>
                            <tr><td id='userError'></td></tr>
                        </tr>
                        <tr>
                            <td><label>Contrase&ntilde;a*:</label></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="pass" id="pass" onchange="validarPassword(this)"/></td>
                            <tr><td id='passError'></td></tr>
                        </tr>
                        <tr>
                            <td><label>Nombre*:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nombre" id="nombre" onchange="validarNombre(this)"/></td>
                            <tr><td id='nombreError'></td></tr>
                        </tr>
                        <tr>
                            <td><label>Apellidos*:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" size="40" name="apellidos" id="apellidos" onchange="validarApellidos(this)"/></td>
                            <tr><td id='apellidosError'></td></tr>
                        </tr>
                        <tr>
                            <td><label>Sexo*:</label></td>
                        </tr>
                        <tr>
                            <td><select name="sexo">
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                </select></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><label>Fecha de nacimiento*:</label></td>
                        </tr>
                        <tr>
                            <td><select name="dia">
                                    <option value="01/">01</option>
                                    <option value="02/">02</option>
                                    <option value="03/">03</option>
                                    <option value="04/">04</option>
                                    <option value="05/">05</option>
                                    <option value="06/">06</option>
                                    <option value="07/">07</option>
                                    <option value="08/">08</option>
                                    <option value="09/">09</option>
                                    <option value="10/">10</option>
                                    <option value="11/">11</option>
                                    <option value="12/">12</option>
                                    <option value="13/">13</option>
                                    <option value="14/">14</option>
                                    <option value="15/">15</option>
                                    <option value="16/">16</option>
                                    <option value="17/">17</option>
                                    <option value="18/">18</option>
                                    <option value="19/">19</option>
                                    <option value="20/">20</option>
                                    <option value="21/">21</option>
                                    <option value="22/">22</option>
                                    <option value="23/">23</option>
                                    <option value="24/">24</option>
                                    <option value="25/">25</option>
                                    <option value="26/">26</option>
                                    <option value="27/">27</option>
                                    <option value="28/">28</option>
                                    <option value="29/">29</option>
                                    <option value="30/">30</option>
                                    <option value="31/">31</option>
                                </select>
                                <select name="mes">
                                    <option value="01/">Enero</option>
                                    <option value="02/">Febrero</option>
                                    <option value="03/">Marzo</option>
                                    <option value="04/">Abril</option>
                                    <option value="05/">Mayo</option>
                                    <option value="06/">Junio</option>
                                    <option value="07/">Julio</option>
                                    <option value="08/">Agosto</option>
                                    <option value="09/">Septiembre</option>
                                    <option value="10/">Octubre</option>
                                    <option value="11/">Noviembre</option>
                                    <option value="12/">Diciembre</option>
                                </select>
                                <select name="ano">
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                    <option value="1979">1979</option>
                                    <option value="1978">1978</option>
                                    <option value="1977">1977</option>
                                    <option value="1976">1976</option>
                                    <option value="1975">1975</option>
                                    <option value="1974">1974</option>
                                    <option value="1973">1973</option>
                                    <option value="1972">1972</option>
                                    <option value="1971">1971</option>
                                    <option value="1970">1970</option>
                                    <option value="1969">1969</option>
                                    <option value="1968">1968</option>
                                    <option value="1967">1967</option>
                                    <option value="1966">1966</option>
                                    <option value="1965">1965</option>
                                    <option value="1964">1964</option>
                                    <option value="1963">1963</option>
                                    <option value="1962">1962</option>
                                    <option value="1961">1961</option>
                                    <option value="1960">1960</option>
                                    <option value="1959">1959</option>
                                    <option value="1958">1958</option>
                                    <option value="1957">1957</option>
                                    <option value="1956">1956</option>
                                    <option value="1955">1955</option>
                                    <option value="1954">1954</option>
                                    <option value="1953">1953</option>
                                    <option value="1952">1952</option>
                                    <option value="1951">1951</option>
                                    <option value="1950">1950</option>
                                </select></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><label>DNI*:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="dni" id="dni" onchange="validarDni(this)"/></td>
                            <tr><td id='dniError'></td></tr>
                        </tr>
                        <tr>
                            <td><input type="submit" name="enviar" value="Enviar" class="input-button" /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?>  
        </div>
    </body>
</html>