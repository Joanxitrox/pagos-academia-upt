<!-- <script>
    
    <script> 
    $('table').dataTable();   
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