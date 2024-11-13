import { fetchData } from "/js/modules/helpers";

const template = document.createElement('template');

template.innerHTML = `
<style>
@import url('/css/carousel.css');
</style>
 

    <div class="carousel">
        <div class="slider">
            <div class="slide-track">
            
            </div>
        </div>
    </div>
 `;
export default class Carousel extends HTMLElement {

    constructor() {
        super();

        this.shadow = this.attachShadow({mode: 'open'});
        this.shadow.appendChild(template.content);
    }

    get site_url() {
        return this.getAttribute('site_url')
    }

    get url() {
        return this.getAttribute('url')
    }


    makeSlideItem = item => `
    <div class="slide carousel-item">
    <a class="category-item" href="#!" data-category="${item.id}">
        <img src="${this.site_url}/images/product-${item.id}.jpg" alt="${item.name}" height="100" with="250">
        <strong class="category-item category-item-title" data-category="${item.id}">${item.name}</strong>
    </a>div>`;


    connectedCallback() {
        const container = this.shadow.querySelector('.slide-track')
        (
            () => {
                fetchData(`${this.url}/categories`)
                .then(categories => {
                    const sliced_categories = categories.slice(0, 7);
                    const concat_categories = sliced_categories.concat(categories.slice(0, 7));
                    let res = concat_categories.map(item => this.makeSlideItem(item)).join('');
                    container.innerHTML = res;

                });
            }
        )();
    }
}