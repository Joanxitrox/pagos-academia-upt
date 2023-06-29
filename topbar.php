<style>
  .logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
  }


  

</style>
<div id="page">
</div>



<div id="loading"></div>
<nav class="navbar navbar-light fixed-top">
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="float-left">
        <a class="navbar-brand" ><img src="assets/uploads/photo_2023-04-05_12-28-13.jpg" width="150px" alt="Logo"></a>
      </div>
      <div class="float-right">
        <div class="dropdown mr-3">
          <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Salir</a>
        </div>
      </div>
    </div>
  </div>
</nav>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script>
  $('#manage_my_account').click(function() {
    uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>