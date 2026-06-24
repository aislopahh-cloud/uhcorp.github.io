
<script>
    const canvas = document.getElementById('morphCanvas');
    const ctx = canvas.getContext('2d');
    let w, h;

    function resize() {
        w = canvas.width = window.innerWidth;
        h = canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    class MorphShape {
        constructor() {
            this.reset();
        }

        reset() {
            this.x = Math.random() * w;
            this.y = Math.random() * h;
            this.radius = 30 + Math.random() * 80;
            this.sides = 4 + Math.floor(Math.random() * 6);
            this.rotation = Math.random() * Math.PI * 2;
            this.speed = 0.1 + Math.random() * 0.2;
            this.driftX = (Math.random() - 0.5) * 0.3;
            this.driftY = (Math.random() - 0.5) * 0.3;
            this.morphSpeed = 0.002 + Math.random() * 0.004;
            this.morphAmount = 0.15 + Math.random() * 0.25;
            this.morphPhase = Math.random() * Math.PI * 2;
            this.hue = 240 + Math.random() * 120;
            this.alpha = 0.04 + Math.random() * 0.06;
            this.time = 0;
        }

        update() {
            this.time += this.morphSpeed;
            this.x += this.driftX;
            this.y += this.driftY;
            this.rotation += this.speed * 0.005;

            if (this.x < -100) this.x = w + 100;
            if (this.x > w + 100) this.x = -100;
            if (this.y < -100) this.y = h + 100;
            if (this.y > h + 100) this.y = -100;
        }

        draw() {
            const points = this.sides;
            const angleStep = (Math.PI * 2) / points;
            const morph = Math.sin(this.time) * this.morphAmount;

            ctx.beginPath();
            for (let i = 0; i <= points; i++) {
                const angle = this.rotation + i * angleStep;
                const r = this.radius * (1 + morph * Math.sin(this.time * 2 + i * 1.5));
                const px = this.x + Math.cos(angle) * r;
                const py = this.y + Math.sin(angle) * r;
                if (i === 0) ctx.moveTo(px, py);
                else ctx.lineTo(px, py);
            }
            ctx.closePath();
            ctx.fillStyle = `hsla(${this.hue + Math.sin(this.time) * 20}, 60%, 60%, ${this.alpha})`;
            ctx.fill();
        }
    }

    const shapes = [];
    for (let i = 0; i < 12; i++) {
        shapes.push(new MorphShape());
    }

    function animate() {
        ctx.clearRect(0, 0, w, h);
        shapes.forEach(s => { s.update(); s.draw(); });
        requestAnimationFrame(animate);
    }

    animate();
</script>
</body>
</html>
