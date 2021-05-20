class ShoppingCart {

    constructor(selector) {

        if (!localStorage.getItem("shoppingCartArticles")) {
            localStorage.setItem("shoppingCartArticles", JSON.stringify({}));
        }
        
        this.articles = JSON.parse(localStorage.getItem("shoppingCartArticles"));
        
        if (selector) {
            this.element = document.createElement("div");
            this.element.innerHTML = `
            <div class="list-group">
                <div class="orderLines"> </div>
                <div class="empty">Panier Vide.</div>
            </div>
            <div class="total-area">
                <span>Total</span>
                <span class="total"></span>
            </div>
            <button class="clearShoppingCart btn btn-primary">Vider le panier</button>
            `;
            document.querySelector(selector).appendChild(this.element);

        }
        
        this.clearShoppingCart();
        this.update();
       

    }

    addArticle(id, name, price, quantity) { 
        // si l'article 'nexite pas
        if (!this.articles[id]) {
            this.articles[id] = {
                "id": id,
                "name": name,
                "price": price,
                "quantity": quantity
            }
        } else {
            this.articles[id].quantity += quantity;
        }

        if (this.articles[id].quantity < 0) {
            this.articles[id].quantity = 0;
        }
        if (this.articles[id].quantity > 50) {
            this.articles[id].quantity = 50;
        }

        this.update();
    }

    removeArticle(id) {
        delete this.articles[id];
        this.update();
    }


    update() {
        this.sumQuantity = 0;
        this.total = 0;
        let orderLinesElement;
        let totalElement;
        let noArticle;


        if (this.element) {
            orderLinesElement = this.element.querySelector(".orderLines");
            totalElement = this.element.querySelector(".total");
            orderLinesElement.innerHTML = "";
            totalElement.innerHTML = "0";
            noArticle =  this.element.querySelector(".empty");
        }

        for (let id in this.articles) {
            let article = this.articles[id];
            if (article.quantity != 0) {
             
                this.sumQuantity += article.quantity;
                if (this.element) {
                    this.total = article.quantity * article.price;
                    let newOrderLine = orderLine(article.id, article.name, article.price, article.quantity, this);
                    orderLinesElement.appendChild(newOrderLine);
                }
            } else {
                delete this.articles[id];
            }

        }
        if (this.element) {
            totalElement.innerHTML = this.total;

            if (Object.keys(this.articles).length == 0 ) {
                noArticle.classList.remove("invisible");
            } else {
                noArticle.classList.add("invisible");
            }
        }
        localStorage.setItem("shoppingCartArticles", JSON.stringify(this.articles));

        $("#quantityShoppingCart").html(this.sumQuantity);

    }

    clearShoppingCart() {
        let clearButton = $(".clearShoppingCart");

        clearButton.click(() => {
            console.log("bravo");
           localStorage.clear();
     //      this.update();
        })
      
    }
}


const orderLine = (id, name, price, quantity, shoppingCart) => {

    let element = document.createElement("div");
    element.innerHTML = `
    <div class="name">
        ${name}
    </div>
    <div class="price">
        ${price}
    </div>
    <button class="decrement btn btn-light font-weight-bold">-</button>
    <div class="quantity">
        ${quantity}
    </div>
    <button class="increment btn btn-light font-weight-bold" >+</button>
    <div class="subTotal">
        ${
        price * quantity
    }
    </div>
    `;
    let addButton = $(element).find(".increment");
    addButton.click(() => {
        shoppingCart.addArticle(id, name, price, 1)
    })

    let decrementButton = $(element).find(".decrement");
    decrementButton.click(() => {
        shoppingCart.addArticle(id, name, price, -1)
    })

    return element;
}
