<?php
class Delivery {
    private DateTime $createdAt;
    private DateTime $estimatedAt;
    private ?DateTime $deliveredAt;

    public function __construct(DateTime $createdAt, DateTime $estimatedAt, ?DateTime $deliveredAt = null) {
        $this->createdAt = $createdAt;
        $this->estimatedAt = $estimatedAt;
        $this->deliveredAt = $deliveredAt;
    }

    public function isLate(): bool {
        if ($this->deliveredAt === null) {
            return false;
        }
        
        return $this->deliveredAt > $this->estimatedAt;
    }

    public function getDelayMinutes(): int {
        if (!$this->isLate()) {
            return 0;
        }
        
        $interval = $this->estimatedAt->diff($this->deliveredAt);
        return $interval->i + ($interval->h * 60) + ($interval->days * 24 * 60);
    }

    public function getDeliveryTime(): ?int {
        if ($this->deliveredAt === null) {
            return null;
        }
        
        $interval = $this->createdAt->diff($this->deliveredAt);
        return $interval->i + ($interval->h * 60) + ($interval->days * 24 * 60);
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getEstimatedAt(): DateTime {
        return $this->estimatedAt;
    }

    public function getDeliveredAt(): ?DateTime {
        return $this->deliveredAt;
    }

    public function setDeliveredAt(DateTime $deliveredAt): void {
        $this->deliveredAt = $deliveredAt;
    }
}

$delivery = new Delivery(
    new DateTime('2024-01-15 10:00:00'), 
    new DateTime('2024-01-15 14:00:00'),
    new DateTime('2024-01-15 14:30:00')  
);

echo "Опоздала? " . ($delivery->isLate() ? 'Да' : 'Нет') . "\n";
echo "Опоздание: " . $delivery->getDelayMinutes() . " минут\n";
echo "Время доставки: " . $delivery->getDeliveryTime() . " минут\n";

$delivery2 = new Delivery(
    new DateTime('2024-01-15 10:00:00'),
    new DateTime('2024-01-15 14:00:00'),
    new DateTime('2024-01-15 13:45:00')
);

echo "\n--- Второй заказ ---\n";
echo "Опоздала? " . ($delivery2->isLate() ? 'Да' : 'Нет') . "\n";
echo "Опоздание: " . $delivery2->getDelayMinutes() . " минут\n";
echo "Время доставки: " . $delivery2->getDeliveryTime() . " минут\n";

$delivery3 = new Delivery(
    new DateTime('2024-01-15 10:00:00'),
    new DateTime('2024-01-15 14:00:00')
);

echo "\n--- Третий заказ (не доставлен) ---\n";
echo "Опоздала? " . ($delivery3->isLate() ? 'Да' : 'Нет') . "\n";
echo "Опоздание: " . $delivery3->getDelayMinutes() . " минут\n";
echo "Время доставки: " . ($delivery3->getDeliveryTime() ?? 'не доставлен') . "\n";