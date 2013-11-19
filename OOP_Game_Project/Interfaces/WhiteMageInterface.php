<?php

interface WhiteMageInterface
{
	/*
	*	Add 5 intelligence to the player, use 20 mana
	*/
	public function holyVerdict();

	/*
	*	Heal player for [intelligence]+20, use 30 mana
	*/
	public function greatHeal();

	/*
	*	Remove [intelligence] to the enemy, use 10 mana
	*/
	public function holyShock(Player enemy);

	public function setMana($mana);
	public function getMana();
}