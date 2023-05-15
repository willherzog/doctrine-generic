<?php

namespace WHDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A default implementation of KeyValueInterface.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
trait KeyValueTrait
{
	#[ORM\Column(length: 99, name: '`key`')]
	protected $key;

	#[ORM\Column(type: 'text', name: '`value`')]
	protected $value;

	#[ORM\Column(type: 'boolean')]
	protected $serialized = false;

	#[ORM\Column(length: 99, nullable: true)]
	protected $scalartype = null;

	public function setKey(string $key): static
	{
		$this->key = $key;

		return $this;
	}

	public function getKey(): ?string
	{
		return $this->key;
	}

	public function setValue(mixed $value): static
	{
		if( is_scalar($value) ) {
			$this->value = (string) $value;
			$this->serialized = false;
			$this->scalartype = gettype($value);
		} else {
			$this->value = serialize($value);
			$this->serialized = true;
		}

		return $this;
	}

	public function getValue(): mixed
	{
		if( $this->serialized ) {
			return unserialize($this->value);
		} else {
			switch( $this->scalartype ) {
				// these must match the strings returned by gettype()
				case 'boolean':
					return (bool) $this->value;
				case 'integer':
					return (int) $this->value;
				case 'double':
					return (float) $this->value;
				default:
					return $this->value;
			}
		}
	}
}
