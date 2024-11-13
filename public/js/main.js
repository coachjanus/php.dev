"use strict";

import Cart from './modules/cart.js';
import Home from './modules/home.js';

import Catalog from '/js/modules/catalog.js';

import Footer from './components/footer.js';
customElements.define('footer-component', Footer);


import Posts from './components/blog.js';
customElements.define('posts-component', Posts);

import Navigation from './components/nav.js';
customElements.define('nav-component', Navigation);

import Login from './components/login.js';
customElements.define('login-component', Login);

import Carousel from './components/carousel.js';
customElements.define('carousel-component', Carousel);

import { fetchData } from '/js/modules/helpers.js';

const hamburger = document.querySelector('#hamburger')
const appNavHide = document.querySelector('.app-nav--hide')
const appNav = document.querySelector('.app-nav')
const appNavShow = document.querySelector('.app-nav-show')

const hideNav = (event) => {
    event.preventDefault()
    appNav.classList.add('app-nav__hide')
    appNav.classList.remove('app-nav__show')
    appNavShow.classList.toggle('hamburger')

}

const showNav = (event) => {
    event.preventDefault()
    console.dir(event.target)
    appNav.classList.toggle('app-nav__hide')
    appNav.classList.toggle('app-nav__show')
    appNavShow.classList.toggle('hamburger')

}

function initNav() {
    appNavHide.addEventListener('click', hideNav);
    appNavHide.addEventListener('touchend', hideNav);

    hamburger.addEventListener('click', showNav);
    hamburger.addEventListener('touchend', showNav);
}

function main() {

    function signIn() {
        const loginComponent = document.querySelector('login-component');

        const shadowRoot = loginComponent.shadowRoot;
        const login = shadowRoot.getElementById('login');
        const signIn = document.querySelector('.sign-in');
        signIn.addEventListener('click', function(){
            login.showModal();
        })
    }
    initNav();

    signIn();

    const url = 'https://my-json-server.typicode.com/coachjanus/db';

    fetchData(`${url}/products`)
    .then(products => {
        // console.dir(products)
   


    let shoppingCart = new Cart();

    const renderButton = container => {
        const buttons = container.querySelectorAll('.add-to-cart');
        shoppingCart.addProductToCartButton(buttons, '.product');
    }
    

    const homePage = document.getElementById('home-page');

    if (homePage) {
        const home = new Home();
        const productContainer = document.querySelector('.product-container');
        productContainer.innerHTML = home.populateProductList(products);

        renderButton(productContainer)

        // const addToCartButtons = document.querySelectorAll('.add-to-cart');
        // shoppingCart.addProductToCartButton(addToCartButtons, '.product');
    }

    const catalogPage = document.getElementById('catalog-page');

    if (catalogPage) {
        const catalog = new Catalog();

        const productContainer = document.querySelector('.product-container');
        productContainer.innerHTML = catalog.populateProductList(products);

        renderButton(productContainer)

        const categoryContainer = document.getElementById('category-container');
        fetchData(`${url}/categories`)
        .then(categories => {
        catalog.populateCategories(categoryContainer, categories);

        let categoryItems = categoryContainer.querySelectorAll('.categories li a');

        categoryItems.forEach(item => item.addEventListener('click' , e => {
            e.preventDefault();
            if (e.target.classList.contains('category-item')) {
                let category = e.target.dataset.id;
                const categoryFilter = items => items.filter(item => item.category == category);
                productContainer.innerHTML = catalog.populateProductList(categoryFilter(products));
            } else {
                productContainer.innerHTML = catalog.populateProductList(products);
            }
            renderButton(productContainer);
        }))
    }); 

        const showOnly = document.getElementById('show-only');
        showOnly.innerHTML = catalog.populateBadges(products);

        let checkBoxes = showOnly.querySelectorAll('input[name="badge"]');
        let values = [];

        checkBoxes.forEach(item => {
            item.addEventListener("change", e => {
                if (e.target.checked) {
                    values.push(item.value)
                }else{
                    if(values.length != 0) {
                        values.pop(item.value)
                    }
                }
                productContainer.innerHTML = values.map(value => catalog.rerenderList(products, value)).join("");
                if(values.length == 0) {
                    productContainer.innerHTML = catalog.populateProductList(products);
                }
                renderButton(productContainer);
            })
        });

        const selectPicker = document.querySelector('.select-picker');
        selectPicker.innerHTML = catalog.sortingOptions();

        selectPicker.addEventListener('change', function() {
            switch(this.value) {
                case 'low-high':
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('price', 'asc')));
                    break;
                case 'high-low':
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('price', 'desc')));
                    break;

                case 'popularity':
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('stars', 'asc')));
                    break;    
                default:
                    productContainer.innerHTML = catalog.populateProductList(products.sort(catalog.compare('id', 'asc')));
            }
            renderButton(productContainer);
        })
    }

    const cartPage = document.getElementById('cart-page');
    if (cartPage) {
        const shoppingCartItems = cartPage.querySelector('.shopping-cart-items')
        shoppingCartItems.innerHTML = shoppingCart.populateShoppingCart(products)
        shoppingCart.renderCart(shoppingCartItems)
    }
}); // end fetch data

}

// 

(() => {
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", main)
    }else {
        main()
    }
})();

