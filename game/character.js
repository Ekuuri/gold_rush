const spriteWidth = 32;
const spriteHeight = 32;

const playerImage = new Image();
playerImage.src = "Character.png";

let gameFrame = 0;
const staggerFrames = 10;

let playerState = "jump";
const spriteAnimations = [];
const animationStates = [
    {
        name: "idle",
        frames: 2,
    },
    {
        name: "sleep",
        frames: 2,
    },
    {
        name: "walk",
        frames: 4,
    },
    {
        name: "run",
        frames: 8,
    },
    {
        name: "crouch",
        frames: 6,
    },
    {
        name: "jump",
        frames: 8,
    },
    {
        name: "shadow",
        frames: 3,
    },
    {
        name: "die",
        frames: 8,
    },
    {
        name: "swing",
        frames: 8,
    }
]

animationStates.forEach((state, index) => {
    let frames = {
        loc: [],
    }
    for (let j = 0; j < state.frames; j++){
        let positionX = j * spriteWidth;
        let positionY = index * spriteHeight;
        frames.loc.push({x: positionX, y: positionY});
    }
    spriteAnimations[state.name] = frames;
})