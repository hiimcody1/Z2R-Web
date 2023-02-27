<section class="py-5 container">
  <div class="row py-lg-5">
    <div class="col-lg-10 col-md-8 mx-auto">
    <div class="card float-left">
      <div class="card-header">
        <h3>Generated Seed</h3>
      </div>
      <div class="card-body">
          <div class="container" id="seedInfo">
            <div class="row">
              <div class="col">
                <div id="seedFlags"></div>
                <div id="seedSeed"></div>
                <div id="seedBuild"></div>
                <div id="seedLogic"></div>
                <div id="seedCreated"></div>
                <div id="seedMeta"></div>
              </div>
              <div class="col text-end text-nowrap">
                  <div class="card-text d-none" id="romUpload">
                  <label for="romfile" class="form-label"><?=_("Your legally-obtained Z2 US Rom backup is required to continue");?></label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="file-needed"><?=_("Zelda II US ROM");?></span>
                      <input type="file" class="form-control" id="romfile" accept=".nes" aria-describedby="file-needed">
                    </div>
                    <div class="alert alert-danger d-none" role="alert" id="badRom"><?=_("Invalid ROM detected. If you feel this is an error, please reload the website and try again!");?></div>
                  </div>
                  <button type="button" class="btn btn-primary" id="downloadSeed">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=_("Save Rom");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button><br /><br />
                  <div class="container text-start">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="sprite-list-label"><?=_("Play as");?></span>
                    <select class="form-select d-none" id="sprite-list" aria-label="Sprite Selection">
                      <option value="-2" data-custom-properties="https://static.hiimcody1.com/images/Random.png">Random|It's a secret to everybody</option>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="beam-list-label"><?=_("Beam Sprite");?></span>
                    <select class="form-select" id="beam-list" aria-label="<?=_("Beam Sprite");?>">
                      <option value=-1>Default</option>
                      <option value=-2>Random</option>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text" id="tunic-color-picker-label"><?=_("Tunic Color");?></span>
                      <select class="form-select" id="tunic-color-picker" aria-label="<?=_("Tunic Color");?>"><option style="background-color:white;" value=-1>[Default]</option></select>
                      &nbsp;&nbsp;
                      <span class="input-group-text" id="shield-color-picker-label"><?=_("Shield Color");?></span>
                      <select class="form-select" id="shield-color-picker" aria-label="<?=_("Shield Color");?>"><option style="background-color:white;" value=-1>[Default]</option></select>
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
                        <input type="checkbox" data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="enableHealthBeep" /> <span class="fs-6"><?=_("Low Health Beep");?></span>
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
                    <br />
                    <div class="row">
                      <div class="col">
                        <input type="checkbox" data-toggle="toggle" data-onlabel="Yes" data-offlabel="No" data-width="75" id="projectNested" /> <span class="fs-6"><?=_("Create ProjectNested ROM [Not Race Legal]");?></span>
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
  loadedSprites=false;
  var seedName="";
  document.getElementById("downloadSeed").addEventListener("click", function() {
      try{
        if(document.getElementById("projectNested").checked) {
          patchedRom = z2Patcher(romFile,patch,!document.getElementById("enableHealthBeep").checked,!document.getElementById("enableMusic").checked,document.getElementById("useFastSpell").checked,document.getElementById("remapUpA").checked,document.getElementById("disableFlashing").checked,document.getElementById("sprite-list").value,document.getElementById("tunic-color-picker").value,document.getElementById("shield-color-picker").value,document.getElementById("beam-list").value);
          patchedRom.fileName=seedName;
          patchedRom.fileType=romFile.fileType;
          //let ips = createIPSFromFiles(romFile,patchedRom);
          //let rawPatch = ips.export("tmp");
          let blob=new Blob([patchedRom._u8array],{type:patchedRom.fileType});
          let formData = new FormData();
          
          formData.append("patch", new File([blob], patchedRom.fileName));
          console.log(formData);
          WebRequest.upload("/api/smc",formData).then((patchResult) => {
            if(patchResult.payload) {
                console.log(patchResult);
                let smcPatchRaw = atob(patchResult.payload.patch);
                const byteNumbers = new Array(smcPatchRaw.length);
                for (let i = 0; i < smcPatchRaw.length; i++) {
                    byteNumbers[i] = smcPatchRaw.charCodeAt(i);
                }
                const byteArray = new Uint8Array(byteNumbers);
                let patchFile = new MarcFile(byteArray);
                patchFile.fileName = seedName + ".smc";
                console.log(patchFile);
                patchFile.save();
            }
          }).catch((error) => {
              console.log(error);
          });
        } else {
          applyPatch(patch,romFile);
        }
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
        initColorPicker("tunic-color-picker");
        initColorPicker("shield-color-picker");
        window.setTimeout(() => {
          populateSpriteList();
          populateBeamSpriteList();
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

function initColorPicker(element) {
  let picker = document.getElementById(element);

  var keys = Object.keys(Z2Rom.palettes);
  let c=0;
  for(let i=0x20;i<0x2C;i++) {
    let square = document.createElement("option");
    square.style.backgroundColor = "rgba("+Z2Rom.palettes[keys[i]].join(", ")+")";
    square.value = keys[i];
    //square.innerText = "";
    //square.innerText = keys[i].toString(16);
    picker.appendChild(square);
  }

  picker.addEventListener("change",(e) => {
    if(e.target.value==-1 || e.target.value=="" || e.target.value==null)
      e.target.style.backgroundColor = "";
    else
      e.target.style.backgroundColor = "rgba("+Z2Rom.palettes[keys[e.target.value]].join(", ")+")";
  });

  if(element.value > 0)
    element.style.backgroundColor = "rgba("+Z2Rom.palettes[keys[element.value]].join(", ")+")";
}

retrieveSeedInfo();
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