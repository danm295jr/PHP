<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Delivery;
use App\CarRental;

echo "    ТЕСТИРОВАНИЕ КЛАССОВ\n";

echo "1. ТЕСТИРОВАНИЕ КЛАССА DELIVERY\n";

echo "\n[Тест 1] Доставка вовремя:\n";
$delivery1 = new Delivery(
    new \DateTime('2024-01-15 10:00:00'),
    new \DateTime('2024-01-15 14:00:00'),
    new \DateTime('2024-01-15 13:45:00')
);
echo "  Создан: " . $delivery1->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
echo "  Плановая доставка: " . $delivery1->getEstimatedAt()->format('Y-m-d H:i:s') . "\n";
echo "  Фактическая доставка: " . $delivery1->getDeliveredAt()->format('Y-m-d H:i:s') . "\n";
echo "  Опоздала? " . ($delivery1->isLate() ? 'ДА' : 'НЕТ') . "\n";
echo "  Время доставки: " . $delivery1->getDeliveryTime() . " минут\n";
echo "  Опоздание: " . $delivery1->getDelayMinutes() . " минут\n";

echo "\n[Тест 1] Доставка с опозданием:\n";
$delivery2 = new Delivery(
    new \DateTime('2024-01-15 10:00:00'),
    new \DateTime('2024-01-15 14:00:00'),
    new \DateTime('2024-01-15 14:30:00')
);
echo "  Создан: " . $delivery2->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
echo "  Плановая доставка: " . $delivery2->getEstimatedAt()->format('Y-m-d H:i:s') . "\n";
echo "  Фактическая доставка: " . $delivery2->getDeliveredAt()->format('Y-m-d H:i:s') . "\n";
echo "  Опоздала? " . ($delivery2->isLate() ? 'ДА' : 'НЕТ') . "\n";
echo "  Время доставки: " . $delivery2->getDeliveryTime() . " минут\n";
echo "  Опоздание: " . $delivery2->getDelayMinutes() . " минут\n";

echo "\n[Тест 1] Доставка не выполнена:\n";
$delivery3 = new Delivery(
    new \DateTime('2024-01-15 10:00:00'),
    new \DateTime('2024-01-15 14:00:00'),
    null
);
echo "  Создан: " . $delivery3->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
echo "  Плановая доставка: " . $delivery3->getEstimatedAt()->format('Y-m-d H:i:s') . "\n";
echo "  Фактическая доставка: НЕ ВЫПОЛНЕНА\n";
echo "  Опоздала? " . ($delivery3->isLate() ? 'ДА' : 'НЕТ') . "\n";
echo "  Время доставки: " . ($delivery3->getDeliveryTime() ?? 'НЕ ДОСТАВЛЕН') . "\n";
echo "  Опоздание: " . $delivery3->getDelayMinutes() . " минут\n";

echo "\n\n2. ТЕСТИРОВАНИЕ КЛАССА CARRENTAL\n";

echo "\n[Тест 2] Аренда на 5 дней:\n";
$rental1 = new CarRental(
    new \DateTime('2024-06-01'),
    new \DateTime('2024-06-06'),
    1500.00
);
echo "  Дата получения: " . $rental1->getPickupDate()->format('Y-m-d') . "\n";
echo "  Дата возврата: " . $rental1->getReturnDate()->format('Y-m-d') . "\n";
echo "  Цена за день: " . $rental1->getPricePerDay() . " руб.\n";
echo "  Количество дней: " . $rental1->getDays() . "\n";
echo "  Общая стоимость: " . $rental1->getTotalPrice() . " руб.\n";
echo "  Просрочена? " . ($rental1->isOverdue() ? 'ДА' : 'НЕТ') . "\n";

echo "\n[Тест 2.2] Аренда менее 24 часов:\n";
$rental2 = new CarRental(
    new \DateTime('2024-06-01 10:00:00'),
    new \DateTime('2024-06-02 09:00:00'),
    2000.00
);
echo "  Дата получения: " . $rental2->getPickupDate()->format('Y-m-d H:i:s') . "\n";
echo "  Дата возврата: " . $rental2->getReturnDate()->format('Y-m-d H:i:s') . "\n";
echo "  Цена за день: " . $rental2->getPricePerDay() . " руб.\n";
echo "  Количество дней: " . $rental2->getDays() . "\n";
echo "  Общая стоимость: " . $rental2->getTotalPrice() . " руб.\n";

echo "\n[Тест 2.] Продление аренды:\n";
$rental3 = new CarRental(
    new \DateTime('2024-06-01'),
    new \DateTime('2024-06-05'),
    1200.00
);
echo "  Исходная стоимость: " . $rental3->getTotalPrice() . " руб.\n";
echo "  Исходное количество дней: " . $rental3->getDays() . "\n";

$rental3->setReturnDate(new \DateTime('2024-06-10'));
echo "  После продления до 10 июня:\n";
echo "  Новое количество дней: " . $rental3->getDays() . "\n";
echo "  Новая стоимость: " . $rental3->getTotalPrice() . " руб.\n";

echo "\n[Тест 2.] Проверка просрочки:\n";
$rental4 = new CarRental(
    new \DateTime('2024-05-01'),
    new \DateTime('2024-05-10'),
    1000.00
);
echo "  Дата возврата: " . $rental4->getReturnDate()->format('Y-m-d') . "\n";
echo "  Текущая дата: " . (new \DateTime())->format('Y-m-d') . "\n";
echo "  Просрочена? " . ($rental4->isOverdue() ? 'ДА (нужно вернуть)' : 'НЕТ') . "\n";

echo "\n\n3. ДОПОЛНИТЕЛЬНЫЕ ТЕСТЫ\n";

echo "\n[Тест 3] Изменение цены за день:\n";
$rental5 = new CarRental(
    new \DateTime('2024-07-01'),
    new \DateTime('2024-07-07'),
    1000.00
);
echo "  Исходная цена: " . $rental5->getPricePerDay() . " руб.\n";
echo "  Исходная стоимость: " . $rental5->getTotalPrice() . " руб.\n";
$rental5->setPricePerDay(1300.00);
echo "  Новая цена: " . $rental5->getPricePerDay() . " руб.\n";
echo "  Новая стоимость: " . $rental5->getTotalPrice() . " руб.\n";

echo "\n[Тест 3] Обновление даты доставки:\n";
$delivery4 = new Delivery(
    new \DateTime('2024-01-20 09:00:00'),
    new \DateTime('2024-01-20 18:00:00')
);
echo "  Статус: " . ($delivery4->getDeliveredAt() ? 'Доставлен' : 'Не доставлен') . "\n";
$delivery4->setDeliveredAt(new \DateTime('2024-01-20 17:30:00'));
echo "  После обновления: ДОСТАВЛЕН\n";
echo "  Время доставки: " . $delivery4->getDeliveryTime() . " минут\n";
echo "  Опоздала? " . ($delivery4->isLate() ? 'ДА' : 'НЕТ') . "\n";

