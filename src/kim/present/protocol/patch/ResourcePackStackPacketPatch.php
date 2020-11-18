<?php

/*
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/gpl-3.0 GPL-3.0 License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\protocol\patch;

trait ResourcePackStackPacketPatch{
    public function encodePayload(){
        $this->putBool($this->mustAccept);
        $this->putUnsignedVarInt(count($this->behaviorPackStack));
        foreach($this->behaviorPackStack as $entry){
            $this->putString($entry->getPackId());
            $this->putString($entry->getPackVersion());
            $this->putString("");
        }

        $this->putUnsignedVarInt(count($this->resourcePackStack));
        foreach($this->resourcePackStack as $entry){
            $this->putString($entry->getPackId());
            $this->putString($entry->getPackVersion());
            $this->putString("");
        }

        // removed: $this->putBool($this->isExperimental);
        $this->putString("1.16.100");

        $this->putLInt(0);     // added: Experiments length
        $this->putBool(false); // added: Were experiments previously toggled
    }
}