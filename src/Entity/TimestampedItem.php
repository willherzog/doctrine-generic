<?php

namespace WHDoctrine\Entity;

use DateTimeInterface;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
interface TimestampedItem
{
	public function getDateCreated(): ?DateTimeInterface;

	public function getDateUpdated(): ?DateTimeInterface;
}
