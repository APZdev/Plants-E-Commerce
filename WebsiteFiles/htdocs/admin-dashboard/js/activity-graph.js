// ----------------- FETCH GRAPH DATA -----------------

let actionsElements = document.querySelectorAll(".activity_action");
let actions = [];
actionsElements.forEach((action) => {
    actions.push(action.innerHTML);
});

let actionsCounts = [];
actions.forEach((action) => {
    if (!actionsCounts.some((e) => e.name == action)) {
        let formattedAction = {
            name: action,
            amount: 1,
        };
        actionsCounts.push(formattedAction);
    } else {
        actionsCounts.forEach((element) => {
            if (element.name == action) {
                element.amount += +1;
            }
        });
    }
});

let percentages = [];
actionsCounts.forEach((actionCount) => {
    let formattedPercentage = {
        name: actionCount.name,
        ratio: actionCount.amount / actions.length,
    };
    percentages.push(formattedPercentage);
});

//Filter actions
let filteredActions = uniq(actions);

// ----------------- DRAW POLYGON GRAPH -----------------

//Math draw simple polygons using cos() and sin() -> https://stackoverflow.com/questions/4839993/how-to-draw-polygons-on-an-html5-canvas

let canvas = document.querySelector(".graph_canvas");
let ctx = canvas.getContext("2d");
ctx.canvas.width = 950;
ctx.canvas.height = 500;

var numberOfSides = filteredActions.length,
    size = 225,
    Xcenter = ctx.canvas.width / 2,
    Ycenter = ctx.canvas.height / 2;

ctx.beginPath();

let offset = 1;

//Draw polygons
for (let k = 1; k <= 5; k++) {
    //Place stroke to starting point of each polygons
    ctx.moveTo(
        Xcenter + size * 0.2 * k * Math.cos((offset * 2 * Math.PI) / numberOfSides),
        Ycenter + size * 0.2 * k * Math.sin((offset * 2 * Math.PI) / numberOfSides)
    );
    let count = 0;
    for (let i = 0 + offset; i <= numberOfSides; i++) {
        //Calculate polygon next corner
        let coordX = Xcenter + size * 0.2 * k * Math.cos(((i + offset) * 2 * Math.PI) / numberOfSides);
        let coordY = Ycenter + size * 0.2 * k * Math.sin(((i + offset) * 2 * Math.PI) / numberOfSides);

        //Draw line from previous corner to the new calculated corner
        ctx.lineTo(coordX, coordY);

        //Execute only around the largest ring
        if (k == 5) {
            //Draw lines from corner to center
            ctx.lineTo(Xcenter, Ycenter);
            //Place stroke back to corner position
            ctx.moveTo(coordX, coordY);

            let fontSize = 0.9;
            ctx.fillStyle = "#3e5e26";
            ctx.font = `bold ${fontSize}rem Arial`;
            let textContent = `${filteredActions[count]} (${(percentages[count].ratio * 100).toFixed(2)} %)`;

            //Condition check if we are on the left side of the polygon, in order to offset texts of the lest side
            if (i <= filteredActions.length / 2) ctx.fillText(textContent, coordX - textContent.length * fontSize * 8, coordY);
            else ctx.fillText(textContent, coordX + fontSize * 16, coordY);
        }

        count++;
    }
}
ctx.strokeStyle = "#588535";
ctx.lineWidth = 1.5;
ctx.stroke();

//Get max percentage to calculate relative percentages
let maxRatio = Math.max.apply(
    Math,
    percentages.map(function (o) {
        return o.ratio;
    })
);

//Simple cross product to get the relative percentages
for (let i = 0; i < percentages.length; i++) {
    percentages[i].ratio = percentages[i].ratio / maxRatio;
}

//Draw colored data area
ctx.beginPath();

let count = 0;
for (let i = 0 + offset; i <= numberOfSides; i++) {
    //Calculate data polygon next corner
    let coordX = Xcenter + size * percentages[count].ratio * Math.cos(((i + offset) * 2 * Math.PI) / numberOfSides);
    let coordY = Ycenter + size * percentages[count].ratio * Math.sin(((i + offset) * 2 * Math.PI) / numberOfSides);

    //Draw line from previous corner to the new calculated corner
    ctx.lineTo(coordX, coordY);

    //Draw text only around the biggest ring

    count++;
}

ctx.fillStyle = "#FF000055";
ctx.closePath(); // go back to point 1
ctx.fill();

ctx.lineWidth = 2;
ctx.strokeStyle = "#FF000099";
ctx.stroke();

// ----------------- UTILITIES -----------------

//Hastables solution -> https://stackoverflow.com/questions/9229645/remove-duplicate-values-from-js-array
function uniq(a) {
    var seen = {};
    return a.filter(function (item) {
        return seen.hasOwnProperty(item) ? false : (seen[item] = true);
    });
}
