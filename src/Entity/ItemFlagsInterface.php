<?php

namespace WHDoctrine\Entity;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
interface ItemFlagsInterface
{
	public function getFlags(): ?array;

	public function hasFlag(string $flag): bool;

	/**
	 * @return bool Whether flag was added (FALSE if already present)
	 */
	public function addFlag(string $flag): bool;

	/**
	 * @return bool Whether flag was removed (FALSE if not present)
	 */
	public function removeFlag(string $flag): bool;
}
