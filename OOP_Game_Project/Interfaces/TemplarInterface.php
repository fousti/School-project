<?php

interface TemplarInterface
{
	/*
	*	Remove 10 strengh point to the enemy
	*/
	public function holyVerdict(Player enemy);

	/*
	*	Heal player for [intelligence]+10 health point, consume 40 mana point
	*/
	public function heal();

	/*
	*	Remove [strengh+10] health point to the enemy and 1 strengh or 1 intelligence when enemy has mana
	*/
	public function shieldBlock(Player enemy);

	public function setMana($mana);
	public function getMana();
}