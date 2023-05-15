<?php

namespace WHDoctrine\Entity;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
interface WeightedItem
{
	public function setWeight(int $weight): static;

	public function getWeight(): int;
}
