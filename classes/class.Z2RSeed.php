<?php
/*
 * File: class.Z2RSeed.php
 * File Created: Tuesday, 17th January 2023 3:21:10 am
 * Author: hiimcody1
 * 
 * Last Modified: Sunday, 22nd January 2023 2:39:20 am
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */


class Z2RSeed {
    public int $id;
    public string $hash;
    public int $seed;
    public string $build;
    public string $logic;
    public string $flags;
    public string $created_at;
    public string $updated_at;
    public string $meta;
    public string $patch;
    
    public function serialize() {
        $rep = Array(
            "hash" => $this->hash,
            "seed" => $this->seed,
            "build" => $this->build,
            "logic" => $this->logic,
            "flags" => $this->flags,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "meta" => $this->meta,
            "patch" => base64_encode($this->patch),
        );
        return $rep;
    }
}
?>