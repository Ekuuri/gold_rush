class House {
    constructor(config) {
        this.element = config.element;
        this.canvas = this.element.querySelector("#game");
        this.ctx = this.canvas.getContext("2d");
    }

    init() {
        const bgImage = new Image();
        bgImage.src = "Mine.png";

        bgImage.onload = () => {
            this.ctx.drawImage(bgImage, 0, 0, canvasWidth, canvasHeight);
        }

        const shadow = new Image();
        shadow.src = "Shadow.png";
        
        const x = 0;
        const y = 0;
        const spriteWidth = 24;
        const spriteHeight = 32;

        const player = new Image();
        player.src = "Character.png";

        player.onload = () => {
            this.ctx.drawImage(player, 0 * spriteWidth, 2 * spriteHeight, 24, 32, x - 2, y - 3, 24, 14)
        }

        shadow.onload = () => {
            this.ctx.drawImage(shadow, 0, 0, 24, 32, x - 5, y - 2, 24, 14)
        }
    }
}