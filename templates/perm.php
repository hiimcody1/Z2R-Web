<section class="py-5 container">
  <div class="row py-lg-5">
    <div class="col-lg-10 col-md-8 mx-auto">
    <div class="card float-left">
      <div class="card-header">
        <h3>Generated Seed</h3>
      </div>
      <div class="card-body">
        <div class="card-text d-none" id="romUpload">
        <label for="romfile" class="form-label"><?=_("Your legally-obtained Z2 US Rom backup is required to continue");?></label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="file-needed"><?=_("Zelda II US ROM");?></span>
            <input type="file" class="form-control" id="romfile" accept=".nes" aria-describedby="file-needed">
          </div>
          <div class="alert alert-danger d-none" role="alert" id="badRom"><?=_("Invalid ROM detected. If you feel this is an error, please reload the website and try again!");?></div>
        </div>
          <div class="container d-none" id="seedInfo">
            <div class="row">
              <div class="col">
                <div id="seedFlags"></div>
                <div id="seedSeed"></div>
                <div id="seedBuild"></div>
                <div id="seedLogic"></div>
                <div id="seedCreated"></div>
                <div id="seedMeta"></div>
              </div>
              <div class="col text-end">
                  <button type="button" class="btn btn-primary" id="downloadSeed">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=_("Save Rom");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button><br /><br />
                  <div class="container text-start">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="sprite-list-label"><?=_("Play as");?></span>
                    <select class="form-select" id="sprite-list" aria-label="Sprite Selection">
                    </select>
                  </div>
                    <div class="row">
                      <div class="col">
                        <input type="checkbox" checked data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="disableFlashing" /> <span class="fs-6"><?=_("Reduce Flashing");?></span>
                      </div>
                      <div class="col">
                        <input type="checkbox" checked data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="enableMusic" /> <span class="fs-6"><?=_("Music");?></span>
                      </div>
                    </div>
                    <br />
                    <div class="row">
                      <div class="col">
                        <input type="checkbox" checked data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="enableHealthBeep" /> <span class="fs-6"><?=_("Low Health Beep");?></span>
                      </div>
                      <div class="col">
                        <input type="checkbox" data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="useFastSpell" /> <span class="fs-6"><?=_("Fast Spell Casting");?></span>
                      </div>
                    </div>
                    <br />
                    <div class="row">
                      <div class="col">
                        <input type="checkbox" checked data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="remapUpA" /> <span class="fs-6"><?=_("Remap Up+A to Up+Select on Controller 1");?></span>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <br /><br />
      </div>
    </div>
    </div>
  </div>
</section>
<script>
  var seedName="";
  document.getElementById("downloadSeed").addEventListener("click", function() {
      try{
        applyPatch(patch,romFile);
      }catch(e){
        console.log(e);
      }
  });

  function retrieveSeedInfo() {
    WebRequest.get("/api/hash/<?=$TemplateVars["_GET"][1]?>").then((response) => {
      if(response.status==200) {
        let seed = response.payload;
        document.getElementById("seedFlags").innerText    = "<?=_("Flags");?>: " + seed.flags;
        document.getElementById("seedSeed").innerText     = "<?=_("Seed");?>: " + seed.seed;
        document.getElementById("seedBuild").innerText    = "<?=_("Build");?>: " + seed.build;
        document.getElementById("seedLogic").innerText    = "<?=_("Logic");?>: " + seed.logic;
        document.getElementById("seedCreated").innerText  = "<?=_("Created on");?>: " + seed.created_at;
        document.getElementById("seedMeta").innerText     = "<?=_("Notes");?>: " + JSON.parse(seed.meta).notes;

        seedName="Z2_" + seed.seed + "_" + seed.flags + ".nes"
        let rawPatch = atob(seed.patch);

        var array = new Uint8Array(rawPatch.length);
        for(var i=0;i<rawPatch.length;i++) {
          array[i] = rawPatch.charCodeAt(i);
        }

        patchFile = new MarcFile(array);

        _readPatchFile();
        window.setTimeout(() => {
          populateSpriteList();
        },250);

      } else if(response.status==404) {
        document.getElementById("seedInfo").innerHTML = '<div class="alert alert-warning" role="alert" id="seedNotFound"><?=_("Seed not found!");?></div>';
      } else {
        document.getElementById("seedInfo").innerHTML = '<div class="alert alert-danger" role="alert" id="seedFailure"><?=_("Error encountered, please try again!");?></div>';
      }
    }).catch((result) => {
      console.log(result);
    });
  }
</script>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<!-- Yes/No Toggles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/js/bootstrap5-toggle.ecmas.min.js"></script>

<!-- Fancy Select Boxes for sprites -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<style>
  .choices {
    width:75%;
  }
</style>

<!-- Rom handling -->
<script type="text/javascript" src="/js/MarcFile.js"></script>
<script type="text/javascript" src="/js/crc.js"></script>
<script type="text/javascript" src="/js/z2/z2rom.js"></script>
<script type="text/javascript" src="/js/z2/ZeldaPatcher.js"></script>
<script type="text/javascript" src="/js/indexedDb.js"></script>
<script type="text/javascript" src="/js/formats/zip.js"></script>
<script type="text/javascript" src="/js/formats/ips.js"></script>
<script type="text/javascript" src="/js/formats/ups.js"></script>
<script type="text/javascript" src="/js/formats/aps.js"></script>
<script type="text/javascript" src="/js/formats/bps.js"></script>
<script type="text/javascript" src="/js/formats/rup.js"></script>
<script type="text/javascript" src="/js/formats/ppf.js"></script>
<script type="text/javascript" src="/js/formats/pmsr.js"></script>
<script type="text/javascript" src="/js/formats/vcdiff.js"></script>
<script type="text/javascript" src="/js/zip.js/zip.js"></script>
<script type="text/javascript" src="/js/RomPatcher.js"></script>
<script type="text/javascript" src="/js/sprites.js"></script>