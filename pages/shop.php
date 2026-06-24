<?php
$itemsDir = __DIR__ . '/../shop-items';
$items = glob($itemsDir . '/*.json');
usort($items, function ($a, $b) {
    $a = json_decode(file_get_contents($a), true);
    $b = json_decode(file_get_contents($b), true);
    return $a['order'] <=> $b['order'];
});
?>

<?php include __DIR__ . '/../header.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<div class="main shop-page">
    <div class="shop-header">
        <h1>Shop</h1>
        <p class="balance"><span class="label">Your Balance</span><span class="amount">0 coins</span></p>
    </div>

    <div class="shop-grid">
        <?php foreach ($items as $itemPath):
            $item = json_decode(file_get_contents($itemPath), true);
            $classes = 'shop-card';
            if (!empty($item['golden'])) $classes .= ' golden';
            if (!empty($item['scaling'])) $classes .= ' scaling';
            $price = number_format($item['price']);
        ?>
        <div class="<?= $classes ?>">
            <div class="card-icon"><img src="/icons/<?= $item['icon'] ?>" alt="<?= htmlspecialchars($item['name']) ?>"></div>
            <div class="card-info">
                <h3><?= htmlspecialchars($item['name']) ?></h3>
                <p class="desc"><?= htmlspecialchars($item['description']) ?></p>
            </div>
            <div class="card-footer">
                <span class="price"><?= $price ?> coins</span>
                <button class="buy-btn">Buy</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.main.shop-page {
    flex-direction: column;
    align-items: stretch;
    justify-content: flex-start;
    padding: 40px;
    gap: 32px;
    height: 100vh;
    overflow-y: auto;
}

.shop-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.shop-header h1 {
    color: rgba(255, 255, 255, 0.85);
    font-weight: 300;
    font-size: 1.8rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.balance {
    display: flex;
    align-items: center;
    gap: 12px;
}

.balance .label {
    color: rgba(255, 255, 255, 0.3);
    font-weight: 300;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
}

.balance .amount {
    color: rgba(255, 255, 255, 0.85);
    font-weight: 400;
    font-size: 1.1rem;
    letter-spacing: 0.05em;
    background: rgba(255, 255, 255, 0.05);
    padding: 6px 16px;
    border-radius: 8px;
}

.shop-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px;
    padding-bottom: 40px;
}

.shop-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    transition: all 0.3s ease;
    position: relative;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
}

.shop-card:hover {
    background: rgba(255, 255, 255, 0.09);
    border-color: rgba(255, 255, 255, 0.16);
    transform: translateY(-2px);
}

.shop-card.golden {
    border-color: rgba(255, 200, 50, 0.4);
    background: linear-gradient(135deg, rgba(255, 200, 50, 0.06), rgba(255, 200, 50, 0.02));
    box-shadow: 0 0 24px rgba(255, 200, 50, 0.06), inset 0 0 24px rgba(255, 200, 50, 0.03);
    overflow: hidden;
}

.shop-card.golden .card-info h3 {
    color: rgba(255, 215, 80, 0.9);
}

.shop-card.golden .price {
    color: rgba(255, 200, 50, 0.6);
}

.shop-card.golden .buy-btn {
    border-color: rgba(255, 200, 50, 0.2);
    color: rgba(255, 200, 50, 0.7);
}

.shop-card.golden .buy-btn:hover {
    background: rgba(255, 200, 50, 0.1);
    border-color: rgba(255, 200, 50, 0.3);
    color: rgba(255, 215, 80, 0.9);
}

.shop-card.golden::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), rgba(255, 215, 80, 0.08), transparent);
    transform: skewX(-20deg);
    animation: shimmer 5s ease-in-out infinite;
}

@keyframes shimmer {
    0%   { left: -100%; }
    40%  { left: 200%; }
    100% { left: 200%; }
}

.shop-card .card-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.shop-card .card-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    image-rendering: pixelated;
}

.shop-card .card-info h3 {
    color: rgba(255, 255, 255, 0.85);
    font-weight: 400;
    font-size: 1.05rem;
    letter-spacing: 0.03em;
    margin-bottom: 4px;
}

.shop-card .card-info .desc {
    color: rgba(255, 255, 255, 0.3);
    font-weight: 300;
    font-size: 0.8rem;
    letter-spacing: 0.04em;
}

.shop-card .card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.shop-card .price {
    color: rgba(255, 255, 255, 0.5);
    font-weight: 300;
    font-size: 0.9rem;
    letter-spacing: 0.03em;
}

.buy-btn {
    background: rgba(255, 255, 255, 0.06);
    color: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 6px 20px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 0.85rem;
    font-weight: 300;
    letter-spacing: 0.05em;
    cursor: pointer;
    transition: all 0.2s ease;
}

.buy-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.18);
    color: rgba(255, 255, 255, 0.9);
}

.shop-card.scaling .price::after {
    content: ' each';
    color: rgba(255, 255, 255, 0.2);
    font-size: 0.75rem;
}
</style>

<?php include __DIR__ . '/../footer.php'; ?>
