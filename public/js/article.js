$(() => {

    var shoppingCart = new ShoppingCart();


    let incrementArticle = $(".incrementArticle");
    let decrementArticle = $(".decrementArticle");
    let addToShoopingCart = $(".addToShoopingCart");
    let linkShoppingCart = $("#linkShoppingCart");
    let quantityShoppingCart = $("#quantityShoppingCart");


    // const updateArticleCard = (cardArticle, quantity) => {
    //     let quantityContainer = cardArticle.find(".quantity");

    //     let id = cardArticle.data("id");
    //     let name = cardArticle.data("name");
    //     let price = cardArticle.data("price");

    //     if (quantity) {
    //         shoppingCart.addArticle(id, name, price, quantity);
    //     }
    //     let updatedQuantity = 0;
    //     if(shoppingCart.articles[id]){
    //         updatedQuantity = shoppingCart.articles[id].quantity;
    //     }
    //     quantityContainer.val(updatedQuantity);
    // };

    const updateCartTotal = () => {
        quantityShoppingCart.html(shoppingCart.sumQuantity);
    };


    const updateArticleCard = (cardArticle, quantityChange) => {
        let quantityContainer = cardArticle.find(".quantity");
        let quantity = parseInt(quantityContainer.val()) + quantityChange;

        if (quantity < 1) {
            quantity = 1;
        }

        quantityContainer.val(quantity);
       
    };

    $(".card.article").each(function (e) { //    updateArticleCard($(this));
    })

    // on vérifie que notre local storage existe et si non on le crée avec un tableau en value (c'est un string)
    const getShoppingCartArticles = () => {
        if (!localStorage.getItem("shoppingCartArticles")) {
            localStorage.setItem("shoppingCartArticles", JSON.stringify([]));
        }
        return JSON.parse(localStorage.getItem("shoppingCartArticles"));
    }


    const setShoppingCartArticles = (articles) => {
        localStorage.setItem("shoppingCartArticles", JSON.stringify(articles));
    };


    incrementArticle.click((e) => {
        let cardArticle = $(e.target.closest(".card.article"));
        updateArticleCard(cardArticle, 1);
    })


    decrementArticle.click((e) => {

        let cardArticle = $(e.target.closest(".card.article"));
        updateArticleCard(cardArticle, -1);

        // let cardArticle = $(e.target.closest(".card.article"));
        // let quantityContainer = cardArticle.find(".quantity");
        //     let quantity = parseInt(quantityContainer.val());
        // let id = cardArticle.data("id");
        // let name = cardArticle.data("name");
        // let price = cardArticle.data("price");

        // shoppingCart.addArticle(id,name,price,-1);
        // quantityContainer.val(shoppingCart.articles[id].quantity)


        // if (quantity > 0) {
        //     quantity -= 1;
        //     quantityContainer.val(quantity);
        // }

    })


    addToShoopingCart.click((e) => {


        let cardArticle = $(e.target.closest(".card.article"));
        let quantityContainer = cardArticle.find(".quantity");
        let quantity = parseInt(quantityContainer.val());

        let id = cardArticle.data("id");
        let name = cardArticle.data("name");
        let price = parseFloat(cardArticle.data("price"));

        if (quantity) {
            shoppingCart.addArticle(id, name, price, quantity);
        }

        quantityContainer.val(1);

      //  updateCartTotal();

        // let id = cardArticle.data("id");

        // // console.log("qté: " + quantity + "id : " + id);

        // localStorage.setItem("article_" + id, quantity);


        // for (let i = 0; i < localStorage.length; i++) {
        //     let sumQuantity = 0;
        //     //       console.log(localStorage.key(i));

        //     let quantityStored = parseInt(localStorage.getItem(localStorage.key(i)));
        //     // console.log(quantityStored);
        //     //        console.log(quantityStored);
        //     sumQuantity += quantityStored;

        // }


        //       linkShoppingCart.append("<div class='border rounded'>" + sumQuantity + "</div>");

    })


})


