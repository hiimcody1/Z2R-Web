<div class="container pt-5">
    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 bg-white border rounded-3">
          <h2>Generate a Preset</h2>
          <p>Generate a Z2R seed from a list of curated flagsets</p>
              <span class="dropdown">
                  <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Generate
                  </a>
                  
                  <ul class="dropdown-menu">
                      <?php
                        $db = new Database();
                        $flagsets = $db->fetchFlagsets();
                        foreach($flagsets as $flagset)
                          echo "<li><a class=\"dropdown-item\" href=\"/generate/preset/{$flagset['id']}\">{$flagset['name']}</a></li>\r\n";
                      ?>
                  </ul>
              </span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-white border rounded-3">
          <h2>Use the Customizer</h2>
          <p>Create a custom Z2R seed by selecting from multiple options and settings</p>
          <a class="btn btn-warning" href="/customizer/start">Launch Web Customizer</a>
          <a href="https://bitbucket.org/digshake/z2randomizer/wiki/Download.md" target="_blank" class="btn btn-secondary my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Download the latest Z2R program to your computer for local generation">Download Local Program</a>
        </div>
      </div>
    </div>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</div>