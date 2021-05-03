var arrayIngRecipe = new Array;
var buttonRecipes;
var buttonReload = document.getElementById("reload");
var ingredientList = [];
var counterIngredient = 1;
var counterRecipes = 0;

/**
 * Create constructor for each Card
 */
class Card {
    constructor(index, name, images) {
        this.index = index;
        this.name = name;
        this.images = images;
    }

    /**
     * Create the card with image
     */
    create(container, type) {

        var cardContent = document.createElement("li");
        var containerIngredient = document.querySelector("#nameIngredient");
        containerIngredient.id = "nameIngredient";
        var contentImage = document.createElement("img");
        contentImage.className = "imgSuggestion";

        // add class card to be able to use animation
        cardContent.className = "cardIngredient";
        // if it's the first, we add "current" to be used with the animation
        if (this.index == 0) {
            cardContent.className += " current";
            containerIngredient.textContent += this.name;
        }
        ingredientList.push(this.name);

        /**add image link */
        contentImage.src = "images/" + type + "/" + this.images;

        /** add element to the parent container */
        cardContent.appendChild(contentImage);
        container.appendChild(cardContent);
    }
}

createButtonrecipe();
creationCard();


/**
 * allows to display button to access recipes
 */
function createButtonrecipe() {
    buttonRecipes = document.createElement("a");
    buttonRecipe.querySelector("#buttonRecipe");
    buttonRecipes.innerHTML = "Voir les recettes";
    buttonRecipe.addEventListener('click', displayValidRecipes);
    buttonRecipe.appendChild(buttonRecipes);

    buttonReload.innerHTML = "Recommencer";
    buttonReload.className ="btn btn-primary mx-auto";
}

/**
 * read the json elements and create the card
 */
function creationCard() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        var container = document.querySelector(".cardlist");
        if (this.readyState == 4 && this.status == 200) {
            var objIngregredient = JSON.parse(this.responseText);
            objIngregredient.forEach(function (element, index) {
                var card = new Card(index, element.ingredients, element.images);
                card.create(container, "ingredients");
            });
        }
    };
    xmlhttp.open("GET", "./js/ingredients.json", true);
    xmlhttp.send();
}

/**
 * allows to skeep each card on click
 */
(function () {
    var animating = false;

    function animatecard(ev) {

        if (animating === false) {
            var t = ev.target;
            /**when the user clicked the "no" button */
            if (t.className === 'but-nope') {
                t.parentNode.classList.add('nope');
                animating = true;
                fireCustomEvent('nopecard', {
                    origin: t,
                    container: t.parentNode,
                    card: t.parentNode.querySelector('.card')
                });
            }
            //when the user clicked the "yes" button 
            if (t.className === 'but-yay') {
                t.parentNode.classList.add('yes');
                animating = true
                fireCustomEvent('yepcard', {
                    origin: t,
                    container: t.parentNode,
                    card: t.parentNode.querySelector('.card')
                });

                //add ingredient into recette list to propose 
                arrayIngRecipe.push(ingredientList[counterIngredient - 1]);
            }
            // actual card => moving 
            if (t.classList.contains('current')) {
                fireCustomEvent('cardchosen', {
                    container: getContainer(t),
                    card: t
                });
            }
        }
    }

    function fireCustomEvent(name, payload) {
        var newevent = new CustomEvent(name, { detail: payload });
        document.body.dispatchEvent(newevent);
    }

    function getContainer(elm) {
        var origin = elm.parentNode;
        if (!origin.classList.contains('cardcontainer')) {
            origin = origin.parentNode;
        }
        return origin;
    }

    /**
     * at the end on the card, close the animation and display recipes
     * @param {*} ev 
     */
    function animationdone(ev) {

        animating = false;
        var origin = getContainer(ev.target);
        //     var infinite = origin.querySelector(".current")
        if (ev.animationName === 'yay') {
            origin.classList.remove('yes');
        }
        if (ev.animationName === 'nope') {
            origin.classList.remove('nope');
        }
        if (origin.classList.contains('list')) {
            if (ev.animationName === 'nope' || ev.animationName === 'yay') {
                origin.querySelector('.current').remove();
                if (!origin.querySelector('.card')) {
                    fireCustomEvent('deckempty', {
                        origin: origin.querySelector('button'),
                        container: origin,
                        card: null
                    });

                } else {
                    origin.querySelector('.card').classList.add('current');
                }
            }
        }

        // allows to display name of ingredients of each click
        var ingredientName = document.querySelector("#nameIngredient");
        ingredientName.innerHTML = ingredientList[counterIngredient];

        counterIngredient++;

        if (counterIngredient == ingredientList.length) {
            counterIngredient = 0;

            displayValidRecipes();
        }
    }
    document.body.addEventListener('animationend', animationdone);
    document.body.addEventListener('webkitAnimationEnd', animationdone);
    document.body.addEventListener('click', animatecard);

})();

/**
 * check the recipes which matches with the ingredients' choices of the user
 */
function checkRecipes() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            myObj.forEach(function (element, index) {
                var haveAllIngredients = true;
                arrayIngRecipe.forEach(ingredients => {
                    if (!element.ingredients.includes(ingredients)) {
                        haveAllIngredients = false;
                    }
                });
                if (haveAllIngredients) {
                    results.innerHTML += '<li ><img class="imgSuggestion" src="images/recipes/' + element.images + '"><p class="text-center">' + element.name + ' </li>';
                    counterRecipes += 1;
                    buttonReload.style.display = 'none';
                }
            });

            if (counterRecipes == 0) {
                let noRecipeContainer = document.querySelector(".noRecipe");
                noRecipeContainer.innerHTML = '<p class = "mt-3 text-center">Aucune recette ne correspond à votre demande.<p>';
           
            }

            counterRecipes = getCounterRecipe();
        }
    };
    xmlhttp.open("GET", "./js/recipes.json", true);
    xmlhttp.send();

}


/**
 * display the valid recipes into the document
 */
function displayValidRecipes() {
    var title = document.querySelector('#titleFridge');
    var cardcontainer = document.querySelector(".cardcontainer");
    buttonRecipe = document.querySelector("#buttonRecipe");
    var nameIngredient = document.querySelector("#nameIngredient");

    title.innerHTML = "Mes recettes";

    checkRecipes();

    results.classList.add('live');
    cardcontainer.style.display = 'none';
    buttonRecipe.style.display = 'none';
    nameIngredient.style.display = 'none';

}
