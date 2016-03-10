<body>
    <div class="grid">
        <h4 class="center">Lista de Evaluados</h4>
        <div class="col_12">
             <div class="center">
                <fieldset>
                    <table class="striped visible" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>RFC</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos as $evaluado) {
                                   $idProfesor = $evaluado["idSicpa"];
                                   $idEvaluado = $evaluado["idEvaluado"]; 
                                   $fila = "<tr>";
                                   $fila .= "<td>".$evaluado["rfc"]."</td>";
                                   $fila .= "<td>".$evaluado["nombre"]."</a></td>";
                                   $fila .= "<td><a class = 'button pop blue' href = '".site_url("evaluador_controller/informacionEvaluado/id/$idProfesor/idEvaluado/$idEvaluado")."'>Evaluar</a></td>";
                                   $fila .= "</tr>";
                                   echo $fila; 
                                }    
                            ?>
                            <!-- <tr class="">
                                <th rel="0" value="RFC 1">RFC 1</th>
                                <td value="Profesor 2">Profesor 1</td>
                                <td value="opciones">
                                    <a href=""><i>Ver</i></a>
                                    <a href=""><i>Evaluar</i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="">
                                <th rel="0" value="RFC 1">RFC 2</th>
                                <td value="Profesor 2">Profesor 2</td>
                                <td value="opciones">
                                    <a href=""><i>Ver</i></a>
                                    <a href=""><i>Evaluar</i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="">
                                <th rel="0" value="RFC 1">RFC 3</th>
                                <td value="Profesor 2">Profesor 3</td>
                                <td value="opciones">
                                    <a href=""><i>Ver</i></a>
                                    <a href=""><i>Evaluar</i></a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
</body>