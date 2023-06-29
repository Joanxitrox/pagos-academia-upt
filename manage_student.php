<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM student where id= " . $_GET['id']);
    foreach ($qry->fetch_array() as $k => $val) {
        $$k = $val;
    }
}
?>
<div class="container-fluid">
    <form action="" id="manage-student">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class="form-group"></div>
        <div class="form-group">
            <label for="" class="control-label">Cedula de Identidad.</label>
            <input type="text" class="form-control" id="id_no" name="id_no" value="<?php echo isset($id_no) ? $id_no : '' ?>" placeholder="Ingresa tu número de identidad">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Nombre y Apellido</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : '' ?>" placeholder="Ingresa tu nombre y apellido">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Contacto</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>" placeholder="Ingresa tu número de contacto">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Correo</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" placeholder="Ingresa tu correo electrónico">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Dirección</label>
            <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Ingresa tu dirección"><?php echo isset($address) ? $address : '' ?></textarea>
        </div>

    </form>
</div>

<script>
    $('#manage-student').on('reset', function() {
        $('#msg').html('')
        $('input:hidden').val('')
    })
    $('#manage-student').submit(function(e) {
        e.preventDefault();
        if (!$.trim($('#id_no').val()) || !$.trim($('#name').val()) || !$.trim($('#contact').val()) || !$.trim($('#email').val()) || !$.trim($('#address').val())) {
            $('#msg').html('<div class="alert alert-danger">Por favor, completa todos los campos.</div>');
            return;
        }
        start_load();
        $('#msg').html('');
        $.ajax({
            url: 'ajax.php?action=save_student',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast('Datos guardados.', 'success');
                    setTimeout(function() {
                        location.reload()
                    }, 1500)
                }
            }
        })
    })
</script>