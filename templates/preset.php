<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <?php
        $db = new Database();
        $preset = $db->fetchFlagsetById($_POST['preset']);
        $seed_number = null;
        
        if($_POST['seed_number'] != '') {
          if(is_numeric($_POST['seed_number']) && strlen($_POST['seed_number']) < 10) {
            $seed_number = $_POST['seed_number'];
          }
        }

        if($preset) {
          $randomizer = new Z2Randomizer(new Z2RFlags($preset['flags']),$seed_number);
          $hash = $randomizer->hash;
          $randomizer->meta = array("notes"=>$preset['name'] . " preset");
          $randomizer->DeferredGenerate();
          include("./templates/loading.php");
        }
      ?>
    </div>
  </div>
</section>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>