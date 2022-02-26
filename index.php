<?PHP
require_once('head.php');
require_once('./persona.php');
$persona = new Persona();
?>
<!-- 
    1- mostrar en una tabla los datos de la persona como son identificacion tipo de documento numero de documento, nombre apellido y la edad
    2- crear una interfas para guardar los nuevos registros ---
    3- eliminar un registro
    4- actualizar un registro
    5- crear una funcion llamada encriptar la cual debe encriptar en md5 un string
    
    utilizar la clase conexion adjunta en el proyecto

-->
<div class="container">
    <div class="row">
        <div class="col">
            <br>
            <div id="_MSG_">
                <?php
                    if(isset($_POST['registrar'])){
                        $response = $persona->persona($_POST["tid"], $_POST["id"], $_POST["name"], $_POST["lastN"], $_POST["DoB"]);
                        if($response == 'existe'){
                            ?>
                            <div class='alert alert-warning' role='alert'>Ya existe una persona con esa Identificación<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }else if($response){
                            ?>
                            <div class='alert alert-primary' role='alert'>Se a registrado!!!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }else {
                            ?>
                            <div class='alert alert-danger' role='alert'>Upps hubó un error al registar???<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }
                    }
                ?>
            </div>
            <form action="" method="post">
                <div class="mb-3">
                    <h2>Registro</h2>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Tipo de Documento</label>
                    <select class="form-select" aria-label="Default select example" name="tid">
                        <?php
                            $tipo = $persona->tipoDocumento();
                            foreach($tipo as $row){
                        ?>    
                            <option value="<?php echo($row['tip_id']); ?>"><?php echo($row['tip_nombre']); ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Identificación</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"  name="id" placeholder="10100******">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"  name="name" placeholder="Ingresa tu nombre">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"  name="lastN" placeholder="Ingresa tu apellido">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="DoB" >
                </div>
                <div class="mb-3">
                    <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <br>
            <div id="_MSG_">
                <?php
                    if(isset($_POST['delete'])){
                        $response = $persona->eliminarPersona($_POST["delete"]);
                        if($response){
                            ?>
                            <div class='alert alert-success' role='alert'>Se a eliminado!!!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }else {
                            ?>
                            <div class='alert alert-danger' role='alert'>Upps hubó un error al eliminar???<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }
                    }
                    if(isset($_POST['save'])){
                        $response = $persona->persona($_POST["tid"], $_POST["id"], $_POST["names"], $_POST["lastN"], $_POST["DoB"],$_POST['save']);
                        if($response == 'existe'){
                            ?>
                            <div class='alert alert-warning' role='alert'>Ya existe una persona con esa Identificación<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }else if($response){
                            ?>
                            <div class='alert alert-primary' role='alert'>Se a actualizado!!!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }else {
                            ?>
                            <div class='alert alert-danger' role='alert'>Upps hubó un error al actualizar???<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: 65%;"></button></div>
                            <?php
                        }
                    }
                ?>
            </div>
            <form action="" method="post">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Tipo Identificación</th>
                        <th scope="col">Identificación</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tabla = $persona->datosTabla();
                            foreach($tabla as $row){
                        ?>
                            <tr>
                            <td>
                                <select class="form-select" aria-label="Default select example" name="tid">
                                    <?php
                                        $tipo = $persona->tipoDocumento();
                                        foreach($tipo as $row2){
                                            if($row2['tip_id'] == $row['tip_id']){
                                    ?>    
                                        <option selected="selected" value="<?php echo($row['tip_id']); ?>"><?php echo($row['tip_nombre']); ?></option>
                                    <?php
                                            }else{
                                    ?>  
                                        <option value="<?php echo($row2['tip_id']); ?>"><?php echo($row2['tip_nombre']); ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="id" value="<?php echo($row['persona_identificacion']); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="names" value="<?php echo($row['persona_nombre']); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="lastN" value="<?php echo($row['persona_apellido']); ?>">
                            </td>
                            <td>
                                <input type="date" class="form-control" id="exampleFormControlInput1"  name="DoB" value="<?php echo($row['persona_fecha']); ?>">
                            </td>
                            <td>
                                <button type="submit" value="<?php echo($row['persona_id']); ?>" class="btn btn-danger" name="delete"><i class="bi bi-x-circle"></i></button>
                                <button type="submit"value="<?php echo($row['persona_id']); ?>" class="btn btn-success" name="save"><i class="bi bi-pencil-square"></i></button>
                                <?php  ?>
                            </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>


<?PHP
require_once('footer.php');
?>
