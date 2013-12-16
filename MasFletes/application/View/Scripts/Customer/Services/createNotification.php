<h1>Notificaciones</h1>
Para servirle mejor favor de proporcionar toda la información que se solicita.
<br />
<br />
<form name="commentForm" id="commentForm" action="Add_Notificacion.php" method="post">
    <table>
        <tr>
            <td><label for="NFFCOR" class="input required">Correo *</label></td>
            <td><input type="text" name="NFFCOR" id="NFFCOR"  class="required email" maxlength="100" value="transportista@masfletes.com" readonly="readonly" size="50" /></td>
        </tr>
        <tr>
            <td><label for="NFFTIA" class="input required">Tipo Acci&oacute;n *</label></td>
            <td>
                <select name="NFFTIA" validate="required:true" title="Selecciona" style="width:165px" >
                    <option value="">--Selecciona--</option>
                    <option value="1" selected="selected">Carga</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="NFFORE" class="input required">Origen Estado *</label></td>
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
            <td><label for="NFFORM" class="input required">Origen Municipio *</label></td>
            <td>
                <select id="NFFORM" disabled="disabled" name="NFFORM" validate="required:true" title="Selecciona" style="width:170px">
                    <option value="">--Selecciona--</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="NFFDEE" class="input required">Destino Estado *</label></td>
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
            <td><label for="NFFDEM" class="input required">Destino Municipio.</label></td>
            <td>
                <select id="NFFDEM" disabled="disabled" name="NFFDEM" validate="required:true" title="Selecciona" style="width:170px">
                <option value="">--Selecciona--</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="NFFVEH" class="input required">Vehic&uacute;lo</label></td>
            <td>
                <select name="NFFVEH" validate="required:true" title="Selecciona" style="width:165px" >
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
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="NFFTVE" class="input required">Tipo de Vehic&uacute;lo</label></td>
            <td>
                <select name="NFFTVE" validate="required:true" style="width:170px" >
                    <option value="">--Seleciona--</option>
                    <option value="26">Caja</option>
                    <option value="25">Cualquiera</option>
                    <option value="23">Plataforma</option>	
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="NFFUSU" value="71" />
                <input type="submit" name="" value="Guardar" />
            </td>
        </tr>
    </table>
</form>