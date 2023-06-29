<?php
// Initialize the session
session_start();

include 'db_connect.php';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM users where id= " . $_GET['id']);
    foreach ($qry->fetch_array() as $k => $val) {
        $$k = $val;

        
    }
}
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "db_connect.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor confirme la contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Algo salió mal, por favor vuelva a intentarlo.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


 Array ( [login_id] => 1 [login_name] => configuroweb [login_username] => hola@configuroweb.com [login_password] => 4b67deeb9aba04a5b54632ad19934f26 [login_type] => 1 )

  #<tbody>
                        <?php
                        include 'db_connect.php';
                        $type = array("", "Admin", "Staff", "");
                        $users = $conn->query("SELECT * FROM users order by name asc");
                        $i = 1;
                        while ($row = $users->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo ucwords($row['name']) ?>
                                </td>

                                <td>
                                    <?php echo $row['username'] ?>
                                </td>
                                <td>
                                    <?php echo $type[$row['type']] ?>
                                </td>

                                <button class="btn btn-primary edit_student" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger delete_student" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash-alt"></i></button> -->









                            script>
    $(document).ready(function() {
        $('table').dataTable()
    })
    $('#new_user').click(function() {
        uni_modal("Nuevo usuario ", "manage_user.php", "mid-large")

    })
    $('.edit_user').click(function() {
        uni_modal("Gestionar Información de usuario", "manage_user.php?id=" + $(this).attr('data-id'), "mid-large")

    })
    $('.delete_user').click(function() {
        _conf("Deseas eliminar este usuario? ", "delete_user", [$(this).attr('data-id')])
    })

    function delete_student($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_usert',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Datos eliminados exitósamente", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>

<!-- <!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambia tu contraseña acá</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Cambia tu contraseña acá</h2>
        <p>Complete este formulario para restablecer su contraseña.</p>
        <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Nueva contraseña</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar">
                <a class="btn btn-link" href="welcome.php">Cancelar</a>
            </div>
        </form>
    </div>    
</body>


<?php 

session_start();


print_r($_SESSION['login_id']);  

/*session was getting*/

?>
</html>-->

<?php include('db_connect.php'); ?>































<!--<div class="container-fluid"> 

    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header"><b>Lista de Usuarios</b>
            </div>

            <div class="card-body">
                <table class="table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $type = array("", "Admin", "Staff", "Alumnus/Alumna");
                        $users = $conn->query("SELECT * FROM users order by name asc");
                        $i = 1;
                        while ($row = $users->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo ucwords($row['name']) ?>
                                </td>

                                <td>
                                    <?php echo $row['username'] ?>
                                </td>
                                <td>
                                    <?php echo $type[$row['type']] ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $('table').dataTable();
    $('#new_user').click(function() {
        uni_modal('Nuevo Usuario', 'manage_user.php')
    })
    $('.edit_user').click(function() {
        uni_modal('Editar Usuario', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
    $('.delete_user').click(function() {
        _conf("¿Deseas eliminar a esta usuario?", "delete_user", [$(this).attr('data-id')])
    })

    function delete_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_user',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Datos eliminados exitósamente", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script> -->