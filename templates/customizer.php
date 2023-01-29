<div class="container pt-5">
<div class="row align-items-md-stretch">
    <div class="col-lg-10 col-md-8 mx-auto">
        <div class="h-100 p-5 bg-white border rounded-3">
            <form method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="seed-flags"><?=_("Seed Flags");?></span>
                    <input type="text" class="form-control" id="seed-flags" name="seed-flags" aria-describedby="seed-flags">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="seed-number"><?=_("Seed Number (Optional)");?></span>
                    <input type="text" class="form-control" id="seed-number" name="seed-number" aria-describedby="seed-number">
                </div>
                <div class="text-end">
                    <a class="btn btn-success" href="#" role="button" aria-expanded="false" id="generate">
                      Generate
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
    <!--<ul class="nav nav-tabs" id="customizerTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="items-tab" data-bs-toggle="tab" data-bs-target="#items-tab-pane" type="button" role="tab" aria-controls="items-tab-pane">Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="overworld-tab" data-bs-toggle="tab" data-bs-target="#overworld-tab-pane" type="button" role="tab" aria-controls="overworld-tab-pane">Overworld</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="entrances-tab" data-bs-toggle="tab" data-bs-target="#entrances-tab-pane" type="button" role="tab" aria-controls="entrances-tab-pane">Entrances</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="enemizer-tab" data-bs-toggle="tab" data-bs-target="#enemizer-tab-pane" type="button" role="tab" aria-controls="enemizer-tab-pane">Enemizer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dungeons-tab" data-bs-toggle="tab" data-bs-target="#dungeons-tab-pane" type="button" role="tab" aria-controls="dungeons-tab-pane">Dungeon Shuffle</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory-tab-pane" type="button" role="tab" aria-controls="inventory-tab-pane">Starting Inventory</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pool-tab" data-bs-toggle="tab" data-bs-target="#pool-tab-pane" type="button" role="tab" aria-controls="pool-tab-pane">Item Pool</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="misc-tab" data-bs-toggle="tab" data-bs-target="#misc-tab-pane" type="button" role="tab" aria-controls="misc-tab-pane">Misc</button>
        </li>
    </ul>
    <div class="tab-content" id="customizerTabContents">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="bg-body">
                <h2>Door Randomizer Customizer</h2>
                <h4>A series of doors...</h4>
                For the truly adventurous, every option you can change in the Door Randomizer is exposed in these tabs.<br />
                It is <b>not</b> recommended to select advanced options combined unless you are familiar with what they do!
            </div>
        </div>
        <div class="tab-pane fade show" id="items-tab-pane" role="tabpanel" aria-labelledby="items-tab" tabindex="0">
            <div class="bg-body">
                <div class="container">
                    <h2>Main Settings</h2>
                    <div class="row">
                        <div class="col">
                        
                        </div>
                        <div class="col">

                        </div>
                        <div class="col-lg">
                        
                        </div>
                    </div>
                    <br />
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="overworld-tab-pane" role="tabpanel" aria-labelledby="overworld-tab" tabindex="0">
            <div class="bg-body">
            <div class="container">
                <h2>Overworld</h2>
                <div class="row">
                    <div class="col">
                    
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                    
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="tab-pane fade" id="entrances-tab-pane" role="tabpanel" aria-labelledby="entrances-tab" tabindex="0">
            <div class="bg-body">
            <div class="container">
                <h2>Entrances</h2>
                <div class="row">
                    <div class="col">
                    
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                    
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="tab-pane fade" id="enemizer-tab-pane" role="tabpanel" aria-labelledby="enemizer-tab" tabindex="0">
            <div class="bg-body">
            <div class="container">
                <h2>Enemizer</h2>
                <div class="row">
                    <div class="col">
                    
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                    
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="tab-pane fade" id="dungeons-tab-pane" role="tabpanel" aria-labelledby="dungeons-tab" tabindex="0">
            <div class="bg-body">
            <div class="container">
                <h2>Dungeons</h2>
                <div class="row">
                    <div class="col">
                    
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                    
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="tab-pane fade" id="inventory-tab-pane" role="tabpanel" aria-labelledby="inventory-tab" tabindex="0">
            <div class="bg-body">
                <h2>Starting Inventory</h2>
                <div class="start-screen"></div>
            </div>
        </div>
        <div class="tab-pane fade" id="pool-tab-pane" role="tabpanel" aria-labelledby="pool-tab" tabindex="0">
            <div class="bg-body">
                
            </div>
        </div>
        <div class="tab-pane fade" id="misc-tab-pane" role="tabpanel" aria-labelledby="misc-tab" tabindex="0">
            <div class="bg-body">
            <div class="container">
                <h2>Misc</h2>
                <div class="row">
                    <div class="col">
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div id="optionDescriptions"></div>
    </div>
-->
</div>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<script>
    document.getElementById("generate").addEventListener("click", (event) => {
        let flags = new FormData().append("flags",document.getElementById("seed-flags").value);
        WebRequest.post("/api/flags/validate",flags).then((result) => {
            if(result.payload) {
                
            }
        }).catch((error) => {
            console.log(error);
        });
    });
</script>