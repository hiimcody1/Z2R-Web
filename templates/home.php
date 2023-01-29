<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light"><?=_("Z2R Web Interface");?></h1>
      <p class="lead text-muted"><?=_("Generate and share Z2R seeds from your browser.");?></p>
      <p>
        <a href="/randomizer" class="btn btn-primary my-2"><?=_("Generate a seed");?></a>
        <a href="https://bitbucket.org/digshake/z2randomizer/wiki/Download.md" target="_blank" class="btn btn-secondary my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?=_("Download the latest Z2R program to your computer for local generation");?>"><?=_("Download Local Program");?></a>
      </p>
    </div>
  </div>
</section>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>