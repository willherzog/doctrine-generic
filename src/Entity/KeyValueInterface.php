<?php

namespace WHDoctrine\Entity;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
interface KeyValueInterface
{
	public function setKey(string $key);

	public function getKey(): ?string;

	public function setValue(mixed $value);

	public function getValue(): mixed;
}
