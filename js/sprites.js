function populateSpriteList() {
    if(!romFile) {
        simplePopulateSpriteList();
        return;
    }
    let spriteCache = indexedDb.obj.spriteCache;
    spriteCache = spriteCache==null? {} : spriteCache;
    let spriteList = document.getElementById("sprite-list").options;

    if(!(-1 in spriteCache)) {
        spriteCache[-1] = {};
        spriteCache[-1]["id"] = -1;
        spriteCache[-1]["name"] = "Link";
        spriteCache[-1]["author"] = "Nintendo";
        spriteCache[-1]["lastUpdate"] = -1;
        spriteCache[-1]["tunicColor"] = "green";
        spriteCache[-1]["shieldColor"] = "red";
        spriteCache[-1]["patch"] = null;
        let tempRomRaw = romFile.seekReadBytes(0,0x02100F);
        var array = new Uint8Array(tempRomRaw.length);
            for(let r=0;r<tempRomRaw.length;r++) {
                array[r] = tempRomRaw[r];
            }

        let tempRom = new MarcFile(array);
        spriteCache[-1]["render"] = renderSprite(tempRom);
    }

    let defaultLink = document.createElement("option");
    defaultLink.text = spriteCache[-1]["name"] + "|" + spriteCache[-1]["author"];
    defaultLink.value = spriteCache[-1]["id"];
    defaultLink.selected = indexedDb.obj.spriteId == -1;
    defaultLink.setAttribute("data-custom-properties",spriteCache[-1]["render"]);
    spriteList.add(defaultLink);

    WebRequest.get("/api/sprites").then((result) => {
    if(result.status==200) {
        let sprites = result.payload;
        for(let i=0;i<sprites.length;i++) {
            let spriteOption = document.createElement("option");
            let sprite = sprites[i];
            if(sprite.id in spriteCache) {
                if(spriteCache[sprite.id]["lastUpdated"] == sprite.lastUpdated) {
                    spriteOption.text = spriteCache[sprite.id]["name"] + "|" + spriteCache[sprite.id]["author"];
                    spriteOption.value = spriteCache[sprite.id]["id"];
                    spriteOption.selected = indexedDb.obj.spriteId == sprite.id;
                    spriteOption.setAttribute("data-custom-properties",spriteCache[sprite.id]["render"]);
                    spriteList.add(spriteOption);
                    continue;
                } else {
                    console.log(spriteCache[sprite.id]["name"] + " " + spriteCache[sprite.id]["lastUpdated"] + " !== " + sprite.lastUpdated + " - Update cache");

                    spriteCache[sprite.id] = {};
                    spriteCache[sprite.id]["id"] = sprite.id;
                    spriteCache[sprite.id]["name"] = sprite.name;
                    spriteCache[sprite.id]["author"] = sprite.author;
                    spriteCache[sprite.id]["lastUpdated"] = sprite.lastUpdated;
                    spriteCache[sprite.id]["tunicColor"] = sprite.tunicColor;
                    spriteCache[sprite.id]["shieldColor"] = sprite.shieldColor;
                    spriteCache[sprite.id]["patch"] = sprite.patch;
                    spriteCache[sprite.id]["render"] = null;
                    
                    let rawPatch = atob(sprite.patch);

                    var array = new Uint8Array(rawPatch.length);
                    for(let r=0;r<rawPatch.length;r++) {
                        array[r] = rawPatch.charCodeAt(r);
                    }

                    let spritePatchRaw = new MarcFile(array);
                    let spritePatch = parseIPSFile(spritePatchRaw);
                    let tempRom = spritePatch.apply(romFile);
                    spriteCache[sprite.id]["render"] = renderSprite(tempRom);

                    spriteOption.text = spriteCache[sprite.id]["name"] + "|" + spriteCache[sprite.id]["author"];
                    spriteOption.value = spriteCache[sprite.id]["id"];
                    spriteOption.selected = indexedDb.obj.spriteId == sprite.id;
                    spriteOption.setAttribute("data-custom-properties",spriteCache[sprite.id]["render"]);
                    spriteList.add(spriteOption);
                }
            } else {
                spriteCache[sprite.id] = {};
                spriteCache[sprite.id]["id"] = sprite.id;
                spriteCache[sprite.id]["name"] = sprite.name;
                spriteCache[sprite.id]["author"] = sprite.author;
                spriteCache[sprite.id]["lastUpdated"] = sprite.lastUpdated;
                spriteCache[sprite.id]["tunicColor"] = sprite.tunicColor;
                spriteCache[sprite.id]["shieldColor"] = sprite.shieldColor;
                spriteCache[sprite.id]["patch"] = sprite.patch;
                spriteCache[sprite.id]["render"] = null;
            }

            let rawPatch = atob(sprite.patch);

            var array = new Uint8Array(rawPatch.length);
            for(let r=0;r<rawPatch.length;r++) {
                array[r] = rawPatch.charCodeAt(r);
            }

            let spritePatchRaw = new MarcFile(array);
            let spritePatch = parseIPSFile(spritePatchRaw);
            let tempRom = spritePatch.apply(romFile);
            spriteCache[sprite.id]["render"] = renderSprite(tempRom);

            spriteOption.text = spriteCache[sprite.id]["name"] + "|" + spriteCache[sprite.id]["author"];
            spriteOption.value = spriteCache[sprite.id]["id"];
            spriteOption.selected = indexedDb.obj.spriteId == sprite.id;
            spriteOption.setAttribute("data-custom-properties",spriteCache[sprite.id]["render"]);
            spriteList.add(spriteOption);
        }
        indexedDb.obj.spriteCache = spriteCache;
        indexedDb.save();
        initSpriteList();
    } else {
        console.log("Failed to load sprites!");
    }
    }).catch((error) => {
    console.log(error);
    });
}

function simplePopulateSpriteList() {
    let spriteList = document.getElementById("sprite-list").options;
    WebRequest.get("/api/sprites").then((result) => {
        if(result.status==200) {
            let sprites = result.payload;
            for(let i=0;i<sprites.length;i++) {
                let spriteOption = document.createElement("option");
                let sprite = sprites[i];
                spriteOption.text = sprite.name + "|" + sprite.author;
                spriteOption.value = sprite.id;
                spriteOption.selected = indexedDb.obj.spriteId == sprite.id;
                spriteList.add(spriteOption);
            }
            initSpriteList();
        } else {
            console.log("Failed to load sprites!");
        }
    }).catch((error) => {
        console.log(error);
    });
}

function populateBeamSpriteList() {
    if(!romFile) {
        return;
    }
    let beamCache = indexedDb.obj.beamCache;
    beamCache = beamCache==null? {} : beamCache;
    let spriteList = document.getElementById("beam-list").options;

    WebRequest.get("/api/beams").then((result) => {
    if(result.status==200) {
        let sprites = result.payload;
        for(let i=0;i<sprites.length;i++) {
            let spriteOption = document.createElement("option");
            let sprite = sprites[i];
            if(sprite.id in beamCache) {
                if(beamCache[sprite.id]["lastUpdated"] == sprite.lastUpdated) {
                    spriteOption.text = beamCache[sprite.id]["name"];
                    spriteOption.value = beamCache[sprite.id]["id"];
                    spriteOption.selected = indexedDb.obj.beamId == sprite.id;
                    spriteOption.setAttribute("data-custom-properties","");
                    spriteList.add(spriteOption);
                    continue;
                }
            } else {
                beamCache[sprite.id] = {};
                beamCache[sprite.id]["id"] = sprite.id;
                beamCache[sprite.id]["name"] = sprite.name;
                beamCache[sprite.id]["author"] = sprite.author;
                beamCache[sprite.id]["lastUpdated"] = sprite.lastUpdated;
                beamCache[sprite.id]["patch"] = sprite.patch;
            }

            let rawPatch = atob(sprite.patch);

            var array = new Uint8Array(rawPatch.length);
            for(let r=0;r<rawPatch.length;r++) {
                array[r] = rawPatch.charCodeAt(r);
            }

            let spritePatchRaw = new MarcFile(array);
            let spritePatch = parseIPSFile(spritePatchRaw);
            let tempRom = spritePatch.apply(romFile);

            spriteOption.text = beamCache[sprite.id]["name"];
            spriteOption.value = beamCache[sprite.id]["id"];
            spriteOption.selected = indexedDb.obj.beamId == sprite.id;
            spriteOption.setAttribute("data-custom-properties","");
            spriteList.add(spriteOption);
        }
        indexedDb.obj.beamCache = beamCache;
        indexedDb.save();
    } else {
        console.log("Failed to load sprites!");
    }
    }).catch((error) => {
    console.log(error);
    });
}

function renderSprite(rom) {
    let translationTableRegular = {
        0: [0,0,0,0],
        1: Z2Rom.palettes[rom.seekReadBytes(0x00285A,1)[0]],
        2: Z2Rom.palettes[rom.seekReadBytes(0x00285B,1)[0]],
        3: Z2Rom.palettes[rom.seekReadBytes(0x00285C,1)[0]]
    }
    let translationTableShield = {
        0: [0,0,0,0],
        1: Z2Rom.palettes[rom.seekReadBytes(0x00285A,1)[0]],
        2: Z2Rom.palettes[rom.seekReadBytes(0x00285B,1)[0]],
        3: Z2Rom.palettes[rom.seekReadBytes(0x000E9E,1)[0]]
    }
    //
    //Adapted from https://github.com/crystalis-randomizer/crystalis-randomizer/blob/2cd9ffb72c24e856d617a666e110babccacc1b9c/src/js/characters.ts
    //
    const bankBase = 0x020010;
    const bankEnd  = 0x02100F;
    const bankSize = 24;

    const mainCanvas = document.createElement("canvas");
    const mainCtx = mainCanvas.getContext("2d");

    const scratchCanvas1 = document.createElement("canvas");
    const scratchCtx1 = scratchCanvas1.getContext("2d");
    const scratchCanvas2 = document.createElement("canvas");
    const scratchCtx2 = scratchCanvas2.getContext("2d");
    const pixel = scratchCtx1.createImageData(128,128);
    const pixel2 = scratchCtx2.createImageData(128,128);

    const tileSize = 8;

    for(let n=0; n<bankSize; n++) {
        const offset = n * 16;
        const x = (n % 16) * 8;
        const y = Math.floor(n / 16) * 8;

        for(let j=0; j < tileSize; j++) {
        const plane0 = rom.seekReadBytes(bankBase + offset + j,1)[0];
        const plane1 = rom.seekReadBytes(bankBase + offset + j + 8,1)[0];
        for (let i=0; i < tileSize; ++i) {
            const pixelbit = 7-i;
            const bit0 = (plane0>>pixelbit) & 1;
            const bit1 = ((plane1>>pixelbit) & 1) << 1;
            //const color = (bit0 | bit1) + (paletteIdx * 4);
            //const appliedColor = basePaletteColors[palette[color]];
            // 3d -> 1d array conversion. the dest is a 3d data[128][128][4] that we
            // access through a 1d view, so we do z + x * width + y * width * height
            const k = (x + i) * 4 + (y + j) * 4 * 128;
            pixel.data[0 + k] = translationTableRegular[(bit0 | bit1)][0]; // R
            pixel.data[1 + k] = translationTableRegular[(bit0 | bit1)][1]; // G
            pixel.data[2 + k] = translationTableRegular[(bit0 | bit1)][2]; // B
            pixel.data[3 + k] = translationTableRegular[(bit0 | bit1)][3]; // A
            scratchCtx1.putImageData(pixel,0,0);
            
            pixel2.data[0 + k] = translationTableShield[(bit0 | bit1)][0]; // R
            pixel2.data[1 + k] = translationTableShield[(bit0 | bit1)][1]; // G
            pixel2.data[2 + k] = translationTableShield[(bit0 | bit1)][2]; // B
            pixel2.data[3 + k] = translationTableShield[(bit0 | bit1)][3]; // A
            scratchCtx2.putImageData(pixel2,0,0);
            //*/
            
        }
        }
    }

    
    let multiplier=0;

    for(let i=0;i<2;i++) {
        let offset=0;
        let scratchCtx = ((i==0)? scratchCtx1 : scratchCtx2);
        for(let c=0;c<64;c+=8) {
            let offsets = [[0+((i+1)*8),0+multiplier],[0+((i+1)*8),8+multiplier],[8+((i+1)*8),0+multiplier],[8+((i+1)*8),8+multiplier]];
            let data = scratchCtx.getImageData(c,0,8,8);
            mainCtx.putImageData(data,offsets[offset][0]+(i*8),offsets[offset][1]);
            offset++;
            if(offset>3) {
                offset=0;
                multiplier+=16;
            }
        }
        multiplier=0;
    }

    

    let finalRender = document.createElement("canvas");
    finalRender.width=32;
    finalRender.height=32;
    finalCtx = finalRender.getContext("2d");
    finalCtx.putImageData(mainCtx.getImageData(8,0,32,32),0,0);

    return finalRender.toDataURL();
}

function initSpriteList() {
    var customTemplates = new Choices(
        document.getElementById('sprite-list'),
        {
            allowHTML: true,
            itemSelectText: "",
            shouldSort: false,
            callbackOnCreateTemplates: function(strToEl) {
            var classNames = this.config.classNames;
            var itemSelectText = this.config.itemSelectText;
            return {
            item: function({ classNames }, data) {
                return strToEl(
                '\
            <div\
                class="' +
                    String(classNames.item) +
                    ' ' +
                    String(
                    data.highlighted
                        ? classNames.highlightedState
                        : classNames.itemSelectable
                    ) +
                    '"\
                data-item\
                data-id="' +
                    String(data.id) +
                    '"\
                data-value="' +
                    String(data.value) +
                    '"\
                ' +
                    String(data.active ? 'aria-selected="true"' : '') +
                    '\
                ' +
                    String(data.disabled ? 'aria-disabled="true"' : '') +
                    '\
                >\
                <span style="margin-right:10px;"><img src="' + (typeof data.customProperties == "string" ? data.customProperties : "https://static.hiimcody1.com/images/Random.png") + '" height=32 /></span> ' +
                    "<span><strong>" + data.label.split("|")[0] + "</strong></span><br /><span style=\"padding-left:48px;position:relative;top:-15px;\" class=\"text-nowrap text-muted small\"><i>" + data.label.split("|")[1] + "</i></span>" +
                    '\
            </div>\
            '
                );
            },
            choice: function({ classNames }, data) {
                return strToEl(
                '\
            <div\
                class="' +
                    String(classNames.item) +
                    ' ' +
                    String(classNames.itemChoice) +
                    ' ' +
                    String(
                    data.disabled
                        ? classNames.itemDisabled
                        : classNames.itemSelectable
                    ) +
                    '"\
                data-select-text="' +
                    String(itemSelectText) +
                    '"\
                data-choice \
                ' +
                    String(
                    data.disabled
                        ? 'data-choice-disabled aria-disabled="true"'
                        : 'data-choice-selectable'
                    ) +
                    '\
                data-id="' +
                    String(data.id) +
                    '"\
                data-value="' +
                    String(data.value) +
                    '"\
                ' +
                    String(
                    data.groupId > 0 ? 'role="treeitem"' : 'role="option"'
                    ) +
                    '\
                >\
                <span style="margin-right:10px;"><img src="' + (typeof data.customProperties == "string" ? data.customProperties : "https://static.hiimcody1.com/images/Random.png") + '" height=32 /></span> ' +
                    "<span><strong>" + data.label.split("|")[0] + "</strong></span><br /><span style=\"padding-left:48px;position:relative;top:-15px;\" class=\"text-nowrap text-muted small\"><i>" + data.label.split("|")[1] + "</i></span>" +
                    '\
            </div>\
            '
                );
            },
            };
        },
        }
    );
    loadedSprites=true;
}