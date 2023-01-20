<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">View Seed</h1>
      <?php
          $db = new Database();
          $seed = $db->fetchSeed($TemplateVars["_GET"][1]);
          if($seed) {
            echo htmlentities(var_export($seed,true));
            ?>
            <script src="/js/"></script>
            <?php
          } else {
            echo "Seed doesn't exist!";
          }
      ?>
    </div>
  </div>
</section>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>