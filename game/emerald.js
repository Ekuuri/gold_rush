class Emerald {
    constructor({emerald}) {
        // count
        this.emerald = emerald;

        // centrování při zvýšení čísla
        ctx.font = '72px "Minecraftia", "VT323"';
        var textNudge = ctx.measureText(this.emerald).width

        this.x = 576 + 448 * 0.46 - textNudge / 2; // 576 - velikost bloku, 448 - velikost menu, textNudge - velikost textu
        this.y = 11;

        this.image = new Image();
        this.image.src = "img/emerald.png"

        
    }

    draw() {
        // EMERALD ICON 
        ctx.drawImage(this.image, 0, 0, 330, 395, this.x, this.y, 66, 79)

        // EMERALD COUNTER
        ctx.textAlign = 'start';
        ctx.textBaseline = 'alphabetic';
        ctx.fillText(this.emerald, this.x + 72, this.y + 64)
    }
}