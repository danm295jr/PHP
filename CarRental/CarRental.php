<?php
class CarRental {
    private DateTime $pickupDate;
    private DateTime $returnDate;
    private float $pricePerDay;

    public function __construct(DateTime $pickupDate, DateTime $returnDate, float $pricePerDay) {
        $this->pickupDate = $pickupDate;
        $this->returnDate = $returnDate;
        $this->pricePerDay = $pricePerDay;
    }

    public function getDays(): int {
        $interval = $this->pickupDate->diff($this->returnDate);
        return $interval->days;
    }

    public function getTotalPrice(): float {
        return $this->getDays() * $this->pricePerDay;
    }

    public function isOverdue(): bool {
        $now = new DateTime();
        return $now > $this->returnDate;
    }

    // Геттеры
    public function getPickupDate(): DateTime {
        return $this->pickupDate;
    }

    public function getReturnDate(): DateTime {
        return $this->returnDate;
    }

    public function getPricePerDay(): float {
        return $this->pricePerDay;
    }

    // Сеттеры
    public function setPickupDate(DateTime $pickupDate): void {
        $this->pickupDate = $pickupDate;
    }

    public function setReturnDate(DateTime $returnDate): void {
        $this->returnDate = $returnDate;
    }

    public function setPricePerDay(float $pricePerDay): void {
        $this->pricePerDay = $pricePerDay;
    }
}

$rental1 = new CarRental(
    new DateTime('2024-06-01'),
    new DateTime('2024-06-10'),
    1500.50
);

echo "--- Аренда 1 ---\n";
echo "Дней аренды: " . $rental1->getDays() . "\n";
echo "Цена за день: " . $rental1->getPricePerDay() . " руб.\n";
echo "Общая стоимость: " . $rental1->getTotalPrice() . " руб.\n";
echo "Просрочена? " . ($rental1->isOverdue() ? 'Да' : 'Нет') . "\n";

$rental2 = new CarRental(
    new DateTime('2024-06-01 10:00:00'),
    new DateTime('2024-06-02 09:00:00'),
    2000.00
);

echo "\n--- Аренда 2 (менее 24 часов) ---\n";
echo "Дней аренды: " . $rental2->getDays() . "\n";
echo "Общая стоимость: " . $rental2->getTotalPrice() . " руб.\n";

$rental3 = new CarRental(
    new DateTime('2024-05-01'),
    new DateTime('2024-05-10'),
    1000.00
);

echo "\n--- Аренда 3 (просроченная) ---\n";
echo "Дата возврата: " . $rental3->getReturnDate()->format('Y-m-d') . "\n";
echo "Просрочена? " . ($rental3->isOverdue() ? 'Да' : 'Нет') . "\n";

$rental4 = new CarRental(
    new DateTime('2024-06-15'),
    new DateTime('2024-06-20'),
    1200.00
);

echo "\n--- Аренда 4 (продление) ---\n";
echo "Исходная стоимость: " . $rental4->getTotalPrice() . " руб.\n";
$rental4->setReturnDate(new DateTime('2024-06-25'));
echo "После продления: " . $rental4->getTotalPrice() . " руб.\n";
echo "Дней аренды: " . $rental4->getDays() . "\n";
