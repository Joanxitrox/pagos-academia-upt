<?php
include('db_connect.php');
session_start();
if (isset($_GET['id'])) {
    $user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
    foreach ($user->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
                <form id="manage-user">
                    <div class="form-group">
                        <label for="" class="control-label">Nombre </label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : '' ?>" placeholder="Ingresa tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Usrname</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? $username : '' ?>" placeholder="Nombre de Usuario">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Correo</label>
                        <input type="email" class="form-control" id="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" placeholder="Ingresa tu contraseña">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#manage-user').submit(function(e) {
        e.preventDefault();
        start_load();

        function new_user(id) {
            start_load();
            $.ajax({
                url: 'ajax.php?action=save_user',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Datos guardados exitósamente", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else if (resp == 2) {
                        $('#msg').html('<div class="alert alert-danger">Username already exists</div>');
                        end_load();
                    }
                }
            });
        }

        new_user(<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>);
    });
</script>