<?php

namespace mytag\event;

use mytag\MyTag;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;

class MyTagListener implements Listener{
    /** @var MyTag */
    private $plugin;
    /**
     * @param MyTag $plugin
     */
    public function __construct(MyTag $plugin){
    	$this->plugin = $plugin;
    }
    /**
     * @return MyTag
     */
    public function getPlugin(){
        return $this->plugin;
    }
    /**
     * @param PlayerChatEvent $event
     */
    public function onPlayerChat(PlayerChatEvent $event){

    }
    /**
     * @param PlayerJoinEvent $event
     */
    public function onPlayerJoin(PlayerJoinEvent $event){

    }
    /**
     * @param PlayerQuitEvent $event
     */
    public function onPlayerQuit(PlayerQuitEvent $event){

    }
}
