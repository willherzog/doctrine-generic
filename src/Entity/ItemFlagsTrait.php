<?php

namespace WHDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

use WHPHP\Util\ArrayUtil;

/**
 * A default implementation of ItemFlagsInterface.
 *
 * Assumes that custom DBAL type WHDoctrine\Type\NullableArrayType has been configured as "array_nullable".
 * If that is not the case, the $flags property below should be overridden to use a different DBAL type.
 *
 * @uses ArrayUtil::removeValue()
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
trait ItemFlagsTrait
{
	#[ORM\Column(type: 'array_nullable', nullable: true)]
	protected ?array $flags = null;

	public function getFlags(): ?array
	{
		return $this->flags;
	}

	public function hasFlag(string $flag): bool
	{
		return $this->flags !== null && in_array($flag, $this->flags, true);
	}

	/**
	 * @inheritDoc
	 */
	public function addFlag(string $flag): bool
	{
		if( $this->flags === null ) {
			$this->flags = [];
		} elseif( in_array($flag, $this->flags, true) ) {
			return false;
		}

		$this->flags[] = $flag;

		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function removeFlag(string $flag): bool
	{
		if( $this->flags === null ) {
			return false;
		}

		return ArrayUtil::removeValue($this->flags, $flag);
	}
}
