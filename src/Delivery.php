<?php

declare(strict_types=1);

namespace App;

use DateTime;

class Delivery
{
    private DateTime $createdAt;
    private DateTime $estimatedAt;
    private ?DateTime $deliveredAt;

    public function __construct(DateTime $createdAt, DateTime $estimatedAt, ?DateTime $deliveredAt = null)
    {
        $this->createdAt = $createdAt;
        $this->estimatedAt = $estimatedAt;
        $this->deliveredAt = $deliveredAt;
    }

    public function isLate(): bool
    {
        if (null === $this->deliveredAt) {
            return false;
        }

        return $this->deliveredAt > $this->estimatedAt;
    }

    public function getDelayMinutes(): int
    {
        if (!$this->isLate()) {
            return 0;
        }

        $interval = $this->estimatedAt->diff($this->deliveredAt);

        return $interval->i + ($interval->h * 60) + ($interval->days * 24 * 60);
    }

    public function getDeliveryTime(): ?int
    {
        if (null === $this->deliveredAt) {
            return null;
        }

        $interval = $this->createdAt->diff($this->deliveredAt);

        return $interval->i + ($interval->h * 60) + ($interval->days * 24 * 60);
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getEstimatedAt(): DateTime
    {
        return $this->estimatedAt;
    }

    public function getDeliveredAt(): ?DateTime
    {
        return $this->deliveredAt;
    }

    public function setDeliveredAt(DateTime $deliveredAt): void
    {
        $this->deliveredAt = $deliveredAt;
    }
}
