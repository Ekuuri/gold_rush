class Pick {
    constructor({pick}) {
        this.pickLevel = pick;

        this.image = new Image();
        this.image.src = `img/pick${this.pickLevel}.png`

        this.x = 0 - 2;
        this.y = 576 - 160 - 4;
    }

    draw() {
        ctx.drawImage(this.image, this.x, this.y)     
    }

    mine(oreLevel) {
        eme += this.pickLevel ** 2 * oreLevel
        totaleme += this.pickLevel ** 2 * oreLevel
    }
}