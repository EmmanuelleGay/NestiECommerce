class ShoppingCart {

    constructor(selector) {

        if (!localStorage.getItem("shoppingCartArticles")) {
            localStorage.setItem("shoppingCartArticles", JSON.stringify({}));
        }

        this.articles = JSON.parse(localStorage.getItem("shoppingCartArticles"));

        if (selector) {
            this.element = document.createElement("div");
            this.element.innerHTML = `

            <h1 class = "col-12 text-center text-primary my-3">Détail de la commande</h1>


            <button class="clearShoppingCart btn btn-info my-3">Vider le panier</button>

            <div class="row my-2">
                <div class="col-3 font-weight-bold">Article</div>
                <div class="col-3 font-weight-bold text-center">Quantité</div>
                <div class="col-3 font-weight-bold text-center">Prix</div>
                <div class="col-3 font-weight-bold text-center">Montant</div>
            </div>
            <div class="row">
                <div class="orderLines col-12"> </div>
                <div class="empty">Panier Vide.</div>
            </div>

            <div class="row justify-content-end mb-3">
                <div class="col-2 font-italic">Montant TVA</div>
                <div class ="vat col-2 font-italic>"></div>
            </div>

            <div class="row justify-content-end">
                <div class="col-2 font-weight-bold">Montant TTC</div>
                <div class="total col-2"></div>
            </div>

            <div class = "row my-3">
                <div class="col-12 font-weight-bold">Renseigner votre moyen de paiement</div>
            </div>
            

            <form>

            <div class = "form-row">
                <div class="col-xs-12 col-md-4 my-1">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fab fa-cc-visa"></i></div>
                        </div>
                        <input type="text" class="form-control" name="order[numberCreditCard]" id="numberCreditCard" placeholder="N° de carte">
                    </div>
                </div>
            </div>

            <div class = "form-row">
                <div class="col-xs-12 col-md-4 my-1">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <input type="date" class="form-control" name="order[expirationCreditCard]" id="expirationCreditCard" placeholder="Date d'expiration">
                    </div>
                </div>
            </div>

            <div class = "form-row">
                <div class="col-xs-12 col-md-4 my-1">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
                        </div>
                        <input type="text" class="form-control" name="order[Cvv]" id="cvv" placeholder="Cvv" max-length="3">
                    </div>
                </div>
            </div>
           
            <div class = "row justify-content-end">
                <a href="JavaScript:void(0);" class = "btn btn-primary validOrder" >Valider la commande</a>
            </div>

         

            </form>
            `;
            document.querySelector(selector).appendChild(this.element);

            $(this.element).find(".validOrder").click(() => this.validateOrder());

        }

        this.clearShoppingCart();
        this.update();


    }


    validateOrder() {

        let creditCardNumber = document.querySelector("#numberCreditCard").value;
        let expirationDate = document.querySelector("#expirationCreditCard").value;
        let ccv = document.querySelector("#cvv").value;


        if(validCreditCard(creditCardNumber)){

            $.post(vars.baseUrl + "/saveOrder", {
                [vars.csrfName]: vars.csrfHash,
                "creditCardNumber": creditCardNumber,
                "expirationDate": expirationDate,
                "ccv": ccv,
                "articles": this.articles
    
            }, (response) => { 
                if(response == "success"){
                    window.location.href = vars.baseUrl + "/commande"
                }
                console.log(response);

            });



        } else{
            alert("Votre numéro de carte n'est pas valide, merci de vérifier votre saisie");
        }

   


    }


    addArticle(id, name, price, quantity) { // si l'article 'nexite pas
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
        this.vat = 0;
        let orderLinesElement;
        let totalElement;
        let vatElement;
        let noArticle;


        if (this.element) {
            orderLinesElement = this.element.querySelector(".orderLines");
            totalElement = this.element.querySelector(".total");
            vatElement = this.element.querySelector(".vat");
            orderLinesElement.innerHTML = "";
            totalElement.innerHTML = "0";
            vatElement.innerHTML = "";
            noArticle = this.element.querySelector(".empty");
        }

        for (let id in this.articles) {
            let article = this.articles[id];
            if (article.quantity != 0) {
                this.sumQuantity += article.quantity;
                if (this.element) {
                    this.total += article.quantity * article.price;
                    let newOrderLine = orderLine(article.id, article.name, article.price, article.quantity, this);
                    orderLinesElement.appendChild(newOrderLine);
                }
            } else {
                delete this.articles[id];
            }

        }
        if (this.element) {
            this.vat = (this.total - this.total / 1.2).toFixed(2);
            this.total = this.total.toFixed(2);

            totalElement.innerHTML = this.total + " €";
            vatElement.innerHTML = this.vat + " €";

            if (Object.keys(this.articles).length == 0) {
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
            this.articles = {};
            this.update();
        })

    }
}


const orderLine = (id, name, price, quantity, shoppingCart) => {

    let element = document.createElement("div");
    element.innerHTML = `

    <div class="row">
        <div class="col-3 name mb-3">${name}</div>
        <div class="col-3 d-flex mb-3 justify-content-center">
            <button class="decrement btn btn-light font-weight-bold">-</button>
            <div class="col-3 text-center quantity">${quantity}</div>
            <button class="increment btn btn-light font-weight-bold">+</button>
        </div>
        <div class="col-3 price mb-3 text-center">${price} €</div>
        <div class="col-3 mb-3 text-center"> ${
        price * quantity
    } €</div>
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

// Takes a credit card string value and returns true on valid number
function validCreditCard(value) { // Accept only digits, dashes or spaces
    if (/[^0-9-\s]+/.test(value)) 
        return false;
    

    // The Luhn Algorithm. It's so pretty.
    let nCheck = 0,
        bEven = false;
    value = value.replace(/\D/g, "");

    for (var n = value.length - 1; n >= 0; n--) {
        var cDigit = value.charAt(n),
            nDigit = parseInt(cDigit, 10);

        if (bEven && (nDigit *= 2) > 9) {
            nDigit -= 9;
        }

        nCheck += nDigit;
        bEven = ! bEven;
    }

    return(nCheck % 10) == 0;
}
