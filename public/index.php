<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Delivery;
use App\CarRental;

$delivery = new Delivery(
    new \DateTime('2024-01-15 10:00:00'),
    new \DateTime('2024-01-15 14:00:00'),
    new \DateTime('2024-01-15 14:30:00')
);

echo "=== Delivery Class ===\n";
echo "Опоздала? " . ($delivery->isLate() ? 'Да' : 'Нет') . "\n";
echo "Опоздание: " . $delivery->getDelayMinutes() . " минут\n";
echo "Время доставки: " . $delivery->getDeliveryTime() . " минут\n\n";

$rental = new CarRental(
    new \DateTime('2024-06-01'),
    new \DateTime('2024-06-10'),
    1500.50
);

echo "=== CarRental Class ===\n";
echo "Дней аренды: " . $rental->getDays() . "\n";
echo "Общая стоимость: " . $rental->getTotalPrice() . " руб.\n";
echo "Просрочена? " . ($rental->isOverdue() ? 'Да' : 'Нет') . "\n";