<?php include('db_connect.php'); ?>
<style>
    input[type=checkbox] {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.3);
        /* IE */
        -moz-transform: scale(1.3);
        /* FF */
        -webkit-transform: scale(1.3);
        /* Safari and Chrome */
        -o-transform: scale(1.3);
        /* Opera */
        transform: scale(1.3);
        padding: 10px;
        cursor: pointer;
    }
</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>

        </div>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header"><b>Lista de Usuarios</b>
            <span class="float:right"><a class="btn btn-primary col-md-2 col-sm-6 float-right" href="javascript:void(0)" id="new_user">
					<i class="fa fa-plus"></i> Usuarios
						</a></span>
            </div>

            <div class="card-body">
                <table class="table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">usuario</th>
                            <th class="">Correo</th>
                            <th class="">Tipo</th>
                            <th class="text-center">Editar</th>                            
                            </td>
                        </tr>
                        </thead>
                        <?php
                                $i = 1;
                                $type = array("", "Admin", "Staff", "");
                                $users = $conn->query("SELECT * FROM users order by name asc ");
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
                                        <td class="text-center">
                                            <button class="btn btn-primary edit_user" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
                                             <button class="btn btn-danger delete_user" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash-alt"></i></button> 
                                        </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        max-width: 100px;
        max-height: 150px;
    }
</style>

<script>

    $(document).ready(function() {
        $('table').dataTable()
    })
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
</script>