document.addEventListener('includes-loaded', () => {
    fetch('shop-items/index.json')
        .then(r => r.json())
        .then(items => {
            const grid = document.querySelector('.shop-grid');
            if (!grid) return;
            grid.innerHTML = '';
            items.forEach(item => {
                const classes = ['shop-card'];
                if (item.golden) classes.push('golden');
                if (item.scaling) classes.push('scaling');
                const price = item.price.toLocaleString();
                const card = document.createElement('div');
                card.className = classes.join(' ');
                card.innerHTML = `
                    <div class="card-icon"><img src="/icons/${item.icon}" alt="${item.name}"></div>
                    <div class="card-info">
                        <h3>${item.name}</h3>
                        <p class="desc">${item.description}</p>
                    </div>
                    <div class="card-footer">
                        <span class="price">${price} coins</span>
                        <button class="buy-btn">Buy</button>
                    </div>
                `;
                grid.appendChild(card);
            });
        });
});
