class Tutorial {
    constructor({x, y, text}) {
        this.x = x;
        this.y = y + 5;
        this.text = text;

        this.fillColor = "red";
        this.textColor = "#FFFFFF";         

        this.radius = 50;
    }

    draw() {
        ctx.fillStyle = this.fillColor;
        ctx.globalAlpha = 0.5

        ctx.beginPath()
        ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI)
        ctx.fill()

        ctx.globalAlpha = 1
        ctx.fillStyle = this.textColor;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = '25px "Minecraftia", "VT323"';
        ctx.fillText(this.text, this.x + 3, this.y + 1);
        
    }
}