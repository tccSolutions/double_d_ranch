<div id="loading_div" class="position-absolute top-50 start-50 translate-middle text-center">
    <img class="" src="/public/images/uploading.gif" alt="">
  </div>

<?php require 'error_handler.php' ?>
</div>  
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>



<!-- JS -->
<script src="../public/js/script.js"></script>

<script>
    $('#loading_div').hide();

    $(".loading").on("click", function(event) {
        $("#loading_div").show();
        $(".form_container").hide()
      })
  </script>
</body>

</html>