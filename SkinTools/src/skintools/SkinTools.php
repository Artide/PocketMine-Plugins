<?php

namespace skintools;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use skintools\command\SkinToolsCommand;
use skintools\event\player\PlayerToggleTouchEvent;
use skintools\event\SkinToolsListener;
use skintools\utils\SkinConverter;

class SkinTools extends PluginBase{
    const MODE_NONE = 0;
    const MODE_GIVE = 1;
    const MODE_STEAL = 2;
    /** @var array */
    public $skinData = [];
    /** @var array */
    public $touchMode = [];
    public function onEnable(){
    	$this->getServer()->getCommandMap()->register("skintools", new SkinToolsCommand($this));
    	$this->getServer()->getPluginManager()->registerEvents(new SkinToolsListener($this), $this);
    }
    /**
     * @param Player $player1
     * @param Player $player2
     */
    public function setStolenSkin(Player $player1, Player $player2){
    	$player1->setSkin($player2->getSkinData());
    }
    /**
     * @param Player $player
     * @param int $touchMode
     */
    public function setTouchMode(Player $player, $touchMode = self::MODE_NONE){
        $event = new PlayerToggleTouchEvent($player, $this->getTouchMode($player), $touchMode);
        $this->getServer()->getPluginManager()->callEvent($event);
        if(!$event->isCancelled()){
            $this->touchMode[strtolower($player->getName())] = $event->getNewMode();
        }
    }
    /**
     * @param Player $player
     * @return int
     */
    public function getTouchMode(Player $player){
        if($this->hasTouchMode($player)){
            return $this->touchMode[strtolower($player->getName())];
        }
        return self::MODE_NONE;
    }
    /**
     * @param Player $player
     */
    public function clearTouchMode(Player $player){
        if($this->hasTouchMode($player)) unset($this->touchMode[strtolower($player->getName())]);
    }
    /**
     * @param Player $player
     * @return bool
     */
    public function hasTouchMode(Player $player){
        return array_key_exists(strtolower($player->getName()), $this->touchMode);
    }
    /** 
     * @param Player $player 
     */
    public function storeSkinData(Player $player){
        $this->skinData[strtolower($player->getName())] = SkinConverter::compress($player->getSkinData());
    }
    /**
     * @param Player $player
     * @return string
     */
    public function getSkinData(Player $player){
        return SkinConverter::uncompress($this->skinData[strtolower($player->getName())]);
    }
    /** 
     * @param Player $player 
     */
    public function removeSkinData(Player $player){
        if($this->isSkinStored($player)) unset($this->skinData[strtolower($player->getName())]);
    }
    /**
     * @param Player $player
     * @return bool
     */
    public function isSkinStored(Player $player){
        return $this->skinData[strtolower($player->getName())] !== null;
    }
}
