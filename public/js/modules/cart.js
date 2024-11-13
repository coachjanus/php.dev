import Store from "./store.js";

export default class Cart {

    cart = [];
    tax = 0.07;

    constructor(key = 'basket') {
        this.cart = Store.init(key);
        this.cartItemsAmount();
    }

    cartItemsAmount() {
        const totalInCart = document.getElementById('total-in-cart');
        totalInCart.textContent = this.cart.reduce((prev, cur) => prev + cur.amount, 0)
    }

    saveCart(key = 'basket') {
        Store.set(key, this.cart);
        this.cartItemsAmount();
    }

    cartItemTemplate = product => `
    <tr class="cart-item" id="id${product.id}">
      <td class="desc" scope="row">
        <a class="name-block" href="#">
          <img src="${product.image}" alt="${product.name}" height="30"> ${product.name}</a>
      </td>
      <td class="product-price">${product.price}</td>
      <td class="qty">
        <div class="number-input quantity" data-id="${product.id}">
          <button class="btn btn-dec">-</button>
          <input class="quantity-result"
            type="number" 
            value="${product.amount}"
            min="1"
            max="10"
            required 
          />
          <button class="btn btn-inc">+</button>
        </div>
      </td>
      <td class="amount">$<span class="product-subtotal">0</span></td>
      <td>
        <a class="remove fas fa-trash-alt" href="#!" data-id="${product.id}"></a>
      </td>
    </tr>`;

    findItem = (items, id) => items.find(item => item.id == id);
    filterItem = (items, id) => items.filter(item => item.id != id);

    populateShoppingCart = products => {
        let res = '';
        this.cart.forEach(item => {
            let product = this.findItem(products, item.id);
            product = {...product, amount: item.amount}
            res += this.cartItemTemplate(product)
        });
        return res;
    }

    addProductToCart(product, amount=1) {
        // console.dir(this.cart)
        let inCart = this.cart.some(item => item.id == product.id);
        // console.dir(inCart)
        if (inCart) {
            // console.dir(product)
            for (let item of this.cart) {
                if(item.id == product.id) {
                    item.amount += amount;
                    this.saveCart();
                    return;
                }
            }
        } else {
            let cartItem = {...product, amount: amount};
            
            this.cart = [...this.cart, cartItem];
            this.saveCart();
        }
            
    }

    addProductToCartButton(addToCartButtons, selector, amount=1) {
       

        addToCartButtons.forEach(element => 
            element.addEventListener('click', event => {
                // console.dir(event.target.closest(selector).dataset.id)
                // event.preventDefault();
                let productyId = event.target.closest(selector).dataset.id;
                let product = {id: productyId}
                // console.dir(product)
                this.addProductToCart(product);
            })
        ); 
    }

    setCartTotal(cartItems) {
        let subTotal = 0;
        let tmpTotal = 0;
        this.cart.map(item => {
            let price = cartItems.querySelector(`#id${item.id} .product-price`).textContent;
            tmpTotal = +price * item.amount;
            cartItems.querySelector(`#id${item.id} .product-subtotal`).textContent = parseFloat(tmpTotal.toFixed(2));
            subTotal += parseFloat(tmpTotal.toFixed(2));
        });
        let cartTax = (subTotal * this.tax).toFixed(2);

        document.querySelector('.cart-subtotal').textContent = subTotal;
        document.querySelector('.cart-tax').textContent = cartTax;
        document.querySelector('.cart-total').textContent = +subTotal + +cartTax;
        
    }

    renderCart(cartItems) {
        this.setCartTotal(cartItems);
        cartItems.addEventListener('click', event => {
            if(event.target.classList.contains('fa-trash-alt')) {
                this.cart = this.filterItem(this.cart, event.target.dataset.id);
                this.setCartTotal(cartItems);
                this.saveCart();
                event.target.closest('.cart-item').remove();
            }
            else if (event.target.classList.contains('btn-inc')) {
                let tmp = this.findItem(this.cart, event.target.closest('.quantity').dataset.id);
                tmp.amount += 1;
                event.target.previousElementSibling.value = tmp.amount;
                this.setCartTotal(cartItems);
                this.saveCart();
            }
            else if (event.target.classList.contains('btn-dec')) {
                let tmp = this.findItem(this.cart, event.target.closest('.quantity').dataset.id);

                if(tmp !== undefined && tmp.amount > 1) {
                    tmp.amount -= 1;
                    event.target.nextElementSibling.value = tmp.amount;
                }else{
                    this.cart = this.filterItem(this.cart, event.target.dataset.id);
                    event.target.closest('.cart-item').remove();
                }  
                this.setCartTotal(cartItems);
                this.saveCart();
            }
        })


    }
}