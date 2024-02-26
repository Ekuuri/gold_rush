class Shop {
    constructor({x, y, text, cost}) {
        this.x = x;
        this.y = y + 5;
        this.text = text + " - " + formatEmerald(this.cost);
        this.cost = cost;

        this.fillColor = "#FFC300";
        this.textColor = "#FFFFFF";         

        this.width = 412;
        this.height = 70;

        this.onClick = null;
        this.isButtonEnabled = true;
    }

    draw() {
        ctx.fillStyle = this.fillColor;
        ctx.fillRect(this.x, this.y, this.width, this.height);

        ctx.fillStyle = this.textColor;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = '25px "Minecraftia", "VT323"';
        ctx.fillText(this.text, this.x + this.width / 2, this.y + this.height / 2, this.width);
    }

    inButton(mouseX, mouseY) {
        return !(mouseX < this.x || mouseX > this.x + this.width || mouseY < this.y || mouseY > this.y + this.height);
    }

    buy() {
        eme -= this.cost;
        this.cost = Math.floor(5 * this.cost + 500)

        if (!this.isButtonEnabled) {
            this.fillColor = "#D5A300";
            this.text = "Max Level Reached!";
        }
    }
}