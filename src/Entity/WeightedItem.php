<?php

namespace WHDoctrine\Entity;

/**
 * Interface for items with a user-defined order.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
interface WeightedItem
{
	public function setWeight(int $weight): static;

	public function getWeight(): int;
}
