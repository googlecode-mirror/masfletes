<h1>Consulta de Cargas General</h1>
Aqui podras buscar la carga que se adapte a tun unidad (click en el numero)
<br />
<br />
<div class="row-fluid">
    <div class="span2" style="margin: 0px;">
        <form id="commentForm" name="frame" action="MasRutaC.php" method="post" target="frame">
            <table>
                <tr>
                    <td><input type="radio" id="RUTRUT" name="RUTRUT" value="1" checked="checked" />Buscar por Estado</td>
                </tr>
                <tr>
                    <td><input type="radio" id="RUTRUT" name="RUTRUT" value="2" />Buscar por Municipio</td>
                </tr>
                <tr>
                    <td><label for="RUTORE" class="input required">Origen Estado </label></td>
                </tr>
                <tr>
                    <td>
                        <select id="RUTORE" name="RUTORE" style="width:170px" >
                            <option value="">--Seleciona Estado--</option>
                            <option value=1>Aguascalientes</option>
                            <option value=2>Baja California</option>
                            <option value=3>Baja California Sur</option>
                            <option value=4>Campeche</option>
                            <option value=5>Coahuila</option>
                            <option value=6>Colima</option>
                            <option value=7>Chiapas</option>
                            <option value=8>Chihuahua</option>
                            <option value=9>Distrito Federal</option>
                            <option value=10>Durango</option>
                            <option value=11>Estado de México</option>
                            <option value=12>Guanajuato</option>
                            <option value=13>Guerrero</option>
                            <option value=14>Hidalgo</option>
                            <option value=15>Jalisco</option>
                            <option value=16>Michoacán</option>
                            <option value=17>Morelos</option>
                            <option value=18>Nayarit</option>
                            <option value=19>Nuevo León</option>
                            <option value=20>Oaxaca</option>
                            <option value=21>Puebla</option>
                            <option value=22>Querétaro</option>
                            <option value=23>Quintana Roo</option>
                            <option value=24>San Luis Potosí</option>
                            <option value=25>Sinaloa</option>
                            <option value=26>Sonora</option>
                            <option value=27>Tabasco</option>
                            <option value=28>Tamaulipas</option>
                            <option value=29>Tlaxcala</option>
                            <option value=30>Veracruz</option>
                            <option value=31>Yucatán</option>
                            <option value=32>Zacatecas</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Origen Municipio. </label></td>
                </tr>
                <tr>
                    <td>
                        <select id="RUTORM" disabled="disabled" name="RUTORM" style="width:170px" >
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Destino Estado </label></td>
                </tr>
                <tr>
                    <td>
                        <select id="RUTORE" name="RUTORE" style="width:170px" >
                            <option value="">--Seleciona Estado--</option>
                            <option value=1>Aguascalientes</option>
                            <option value=2>Baja California</option>
                            <option value=3>Baja California Sur</option>
                            <option value=4>Campeche</option>
                            <option value=5>Coahuila</option>
                            <option value=6>Colima</option>
                            <option value=7>Chiapas</option>
                            <option value=8>Chihuahua</option>
                            <option value=9>Distrito Federal</option>
                            <option value=10>Durango</option>
                            <option value=11>Estado de México</option>
                            <option value=12>Guanajuato</option>
                            <option value=13>Guerrero</option>
                            <option value=14>Hidalgo</option>
                            <option value=15>Jalisco</option>
                            <option value=16>Michoacán</option>
                            <option value=17>Morelos</option>
                            <option value=18>Nayarit</option>
                            <option value=19>Nuevo León</option>
                            <option value=20>Oaxaca</option>
                            <option value=21>Puebla</option>
                            <option value=22>Querétaro</option>
                            <option value=23>Quintana Roo</option>
                            <option value=24>San Luis Potosí</option>
                            <option value=25>Sinaloa</option>
                            <option value=26>Sonora</option>
                            <option value=27>Tabasco</option>
                            <option value=28>Tamaulipas</option>
                            <option value=29>Tlaxcala</option>
                            <option value=30>Veracruz</option>
                            <option value=31>Yucatán</option>
                            <option value=32>Zacatecas</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Destino Municipio. </label></td>
                </tr>
                <tr>
                    <td>
                        <select id="RUTDEM" disabled="disabled" name="RUTDEM" style="width:170px">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="RUTVEH" class="">Vehic&uacute;lo</label></td>
                </tr>
                <tr>
                    <td>
                        <select name="RUTVEH" style="width:170px">
                            <option value="">--Seleciona--</option>
                            <option value=12>Autobus</option>
                            <option value=3>Camioneta de 3.5</option>
                            <option value=4>Camioneta de 4.5</option>
                            <option value=9>Coche</option>
                            <option value=23>F550 o HD</option>
                            <option value=5>Full</option>
                            <option value=6>Grua 3.5 Tons</option>
                            <option value=7>Grua para Unidad Pesada</option>
                            <option value=22>H100</option>
                            <option value=11>Hand Carrier</option>
                            <option value=15>LowBoy</option>
                            <option value=10>Nissan</option>
                            <option value=8>Pickup</option>
                            <option value=16>Por Tarima</option>
                            <option value=13>Rabon</option>
                            <option value=1>Torthon</option>
                            <option value=2>Trailer</option>
                        </select></td>
                </tr>
                <tr>
                    <td><label>Fecha Inicio</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="RUTFEI" id="RUTFEI" style="width:165px" /></td>
                </tr>
                <tr>
                    <td><label>Fecha Fin</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="RUTFEF" id="RUTFEF" style="width:165px" /></td>
                </tr>
            </table>
            <br />
            <input type="submit" name="BuscarRuta" value="Consulta Ruta" />
        </form>
    </div>
    <div class="span10" style="margin: 0px;">
        <table class="table">
            <thead>
                <tr>
                    <th><center>Borrar</center></th>
                    <th><center>Ruta</center></th>
                    <th><center>Origen Estado</center></th>
                    <th><center>Origen Municipio</center></th>
                    <th><center>Destino Estado</center></th>
                    <th><center>Destino Municipio</center></th>
                    <th><center>Fecha Ruta</center></th>
                    <th><center>Duraci&oacute;n</center></th>
                    <th><center>Veh&iacute;culo</center></th>
                    <th><center>Modificar</center></th>
                    <th><center>Duplicar</center></th>
                </tr>
            </thead>
        </table>
    </div>
</div>