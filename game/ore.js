class Ore {
    constructor({ore}) {
        this.oreLevel = ore;

        this.image = new Image();
        this.image.src = `img/ore${this.oreLevel}.png`
    }

    draw() {
        ctx.drawImage(this.image, 2, 1, 400, 400, 0, 0, 578, 579) // x, y, sirka zdroje, vyska zdroje, x zdroje, y zdroje, deformace x, deformace y
    }
}