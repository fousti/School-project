<?php

interface WarriorInterface
{
	/*
	*	Add 20 strengh to the player
	*/
	public function battleRoar();

	/*
	*	Remove [ computed strenghs] + 10 health point to the enemy
	*/
	public function berserkSlam(Player enemy);

	/*
	*	Remove 10 velocity to the enemy
	*/
	public function bigStomp(Player enemy);
}