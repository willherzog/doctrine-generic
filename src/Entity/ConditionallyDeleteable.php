<?php

namespace WHDoctrine\Entity;

/**
 * Interface for items which should not always be deleteable (based on some internal condition(s)).
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
interface ConditionallyDeleteable
{
	/**
	 * Whether a request to delete this item should result in a 409 Conflict response.
	 */
	public function shouldNotBeDeleted(): bool;
}
