<?php

declare(strict_types=1);

namespace App;

use DateTime;

class CarRental
{
    private DateTime $pickupDate;
    private DateTime $returnDate;
    private float $pricePerDay;

    public function __construct(DateTime $pickupDate, DateTime $returnDate, float $pricePerDay)
    {
        $this->pickupDate = $pickupDate;
        $this->returnDate = $returnDate;
        $this->pricePerDay = $pricePerDay;
    }

    public function getDays(): int
    {
        $interval = $this->pickupDate->diff($this->returnDate);

        return $interval->days;
    }

    public function getTotalPrice(): float
    {
        return $this->getDays() * $this->pricePerDay;
    }

    public function isOverdue(): bool
    {
        $now = new DateTime();

        return $now > $this->returnDate;
    }

    public function getPickupDate(): DateTime
    {
        return $this->pickupDate;
    }

    public function getReturnDate(): DateTime
    {
        return $this->returnDate;
    }

    public function getPricePerDay(): float
    {
        return $this->pricePerDay;
    }

    public function setPickupDate(DateTime $pickupDate): void
    {
        $this->pickupDate = $pickupDate;
    }

    public function setReturnDate(DateTime $returnDate): void
    {
        $this->returnDate = $returnDate;
    }

    public function setPricePerDay(float $pricePerDay): void
    {
        $this->pricePerDay = $pricePerDay;
    }
}
