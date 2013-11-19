<?php

interface PlayerInterface
{
	/*
	*	SETTER
	*/
	public function setName($name);
	public function setStrengh($strengh);
	public function setVelocity($velocity);
	public function setIntelligence($intelligence);
	public function setHealthPoint($hp);
	public function setWeapon(Weapon $weapon);
	public function setWeapons(Array $weapons);

	/*
	*	GETTER
	*/
	public function getName();
	public function getStrengh();  // return player strengh + strengh bonuses from weapons
	public function getVelocity();
	public function getIntelligence();
	public function getHealthPoint();

	// Remove [computed strenghs] value to the health point enemy
	public function attack(Player enemy);
}