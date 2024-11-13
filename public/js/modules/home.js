
export default class Home {

    productItemTemplate = product => `<div class="card">
    <div class="product" data-id="${product.id}">                 
        <figure class="image badge badge-${product.badge}">
            <img src="${product.image}" alt="${product.name}" srcset="">
        </figure>

        <div class="card-body">
            <h3 class="card-title">${product.name}</h3>
                <div class="product-meta">
                    <div class="price">${product.price}</div>
                    <div class="icon-actions">
                        <a href="#" class="fas fa-shopping-cart add-to-cart icon icon--inline"></a>
                        <a href="#" class="fas fa-heart add-to-wishlist icon icon--inline"></a>
                        <a href="#" class="fas fa-eye icon icon--inline"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>`;

    populateProductList = (products) => {
        let contemt = '';
        products.forEach(element => 
            contemt += this.productItemTemplate(element)
        );
        return contemt;
    }
}