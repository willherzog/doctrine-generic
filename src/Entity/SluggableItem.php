<?php

namespace WHDoctrine\Entity;

/**
 * Interface for items with name-based, URL-safe "slugs".
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
interface SluggableItem
{
	/**
	 * A unique identifier for this item.
	 */
	public function getSlug(): ?string;

	/**
	 * Set a unique identifier for this item and return the item.
	 */
	public function setSlug(?string $slug): static;
}
