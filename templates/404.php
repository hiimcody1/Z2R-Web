<?php
    header("HTTP/1.0 404 Not Found");
?>
<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light"><?=_("Z2R Web Interface");?></h1>
      <p class="lead text-warning"><?=_("Page not found!");?></p>
    </div>
  </div>
</section>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>