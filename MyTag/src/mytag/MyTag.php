<?php

namespace mytag;

use mytag\command\MyTagCommand;
use mytag\event\MyTagListener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Player;

class MyTag extends PluginBase{
    /** @var Config */
    public $nametags;
    public function onEnable(){
        $this->saveFiles();
        $this->registerAll();
    }
    private function saveFiles(){
    	if(!is_dir($this->getDataFolder())) mkdir($this->getDataFolder());
        if(file_exists($this->getDataFolder()."config.yml")){
            if($this->getConfig()->get("version") !== $this->getDescription()->getVersion() or !$this->getConfig()->exists("version")){
		$this->getServer()->getLogger()->warning("An invalid configuration file for ".$this->getDescription()->getName()." was detected.");
		if($this->getConfig()->getNested("plugin.autoUpdate") === true){
		    $this->saveResource("config.yml", true);
                    $this->getServer()->getLogger()->warning("Successfully updated the configuration file for ".$this->getDescription()->getName()." to v".$this->getDescription()->getVersion().".");
		}
	    }  
        }
        else{
            $this->saveDefaultConfig();
        }
        $this->nametags = new Config($this->getDataFolder()."nametags.yml", Config::YAML);
    }
    public function registerAll(){
    	$this->getServer()->getCommandMap()->register("mytag", new MyTagCommand($this));
        $this->getServer()->getPluginManager()->registerEvents(new MyTagListener($this), $this);
    }
    /**
     * @param Player $player
     * @return string
     */
    public function getSavedNameTag(Player $player){
        return $this->nametags->get(strtolower($player->getName()));
    }
    /**
     * @param Player $player
     */
    public function saveNameTag(Player $player){
        $this->nametags->set(strtolower($player->getName()), $player->getNameTag());
        $this->nametags->save();
    }
}
