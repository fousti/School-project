<?php

interface WizardInterface
{
	/*
	*	Remove [intelligence] health point to the player
	*/
	public function blackFireBolt(Player enemy);

	/*
	*	Remove 50 health point to the player and 70 health point to the enemy
	*/
	public function blackSacrifice(Player enemy);

	/*
	*	Remove [intelligence] health point to the enemy
	*/
	public function blackStorm(Player enemy);

	/*
	*	Add 5 intelligence point and remove 10 health point to the player
	*/
	public function darkBoost();

	public function setMana($mana);
	public function getMana();
}