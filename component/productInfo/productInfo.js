

// const opinions = [
//     `
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// `,
// `
// opinion2 opinion2 opinion2 opinion2 opinion2 opinion2 opinion2
// opinion2 opinion2 opinion2 opinion2 opinion2 opinion2 opinion2
// opinion2 opinion2 opinion2 opinion2 opinion2 opinion2 opinion2
// opinion2 opinion2 opinion2 opinion2 opinion2 opinion2 opinion2
// opinion2 opinion2 opinion2 opinion2 opinion2 opinion2 opinion2
// opinion2 opinion2 opinion2 opinion2 opinion2 opinion2 opinion2
// `
// ,
// `
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// opinion3 opinion3 opinion3 opinion3 opinion3 opinion3 opinion3
// `,
// `
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// `,
// `
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem laudantium quo magnam! Beatae repudiandae maiores, debitis, expedita aliquam magni, aut doloremque error veritatis a impedit sequi aspernatur. Expedita, eos! 
// `,
// ]



// let productInfo = {
//     id: 1,
//     ACR: 5,
//     productImg: `../img/iPhone13.png`,
//     productName: `Iphon13`,
//     productPrice: '1600',
//     productDes: `
//     The iPhone 13 has a 6.1-inch screen, and the iPhone 13 mini has a 5.4-inch screen. They both use Apple's Ceramic Shield cover glass, which adds improved drop protection. The Super Retina XDR display is 28% brighter up to 800 nits for regular content 1200 nits for HDR.
//     `,
//     opinion: opinions
// }

let star_html = `<i class="item_box__info__ul__item__rating fa-solid fa-star"></i>`


// Object.keys(productInfo).forEach(key => {
//     if(key == 'id') return;

//     if(key == 'ACR') {
//         star_html = star_html.repeat(productInfo[key]);
//         return;
//     };

//     if(key ==  'productPrice') {
//         productInfo[key] = parseInt(productInfo[key]).toLocaleString('en-CA', { style: 'currency', currency: 'CAD' });
//     }
    
//     let limit = key == 'productDes'? 200: 'opinion'? 140: 30;

//     if(key == 'productDes') return;

//     if(key == 'opinion') {
//         // productInfo[key] = productInfo[key].map(i => i.length > limit? i.slice(0,limit) + '...': i);
//         return;
//     }

//     productInfo[key] = 
//     productInfo[key].length > limit? 
//     productInfo[key].slice(0, limit) + '...':productInfo[key];
// });

// const {id, ACR, productImg, productName, productPrice, productDes, opinion} = productInfo;


const urlParamsId = new URLSearchParams(window.location.search);
    const itemId = urlParamsId.get('id');


$.ajax({
    url: "../database/item.php",
    type: "GET",
    dataType: "json",
    data: {
        id: itemId
    },
    success: function(response) {
        // Update the HTML with the fetched data
        showData(response);
        $('.product_info').html(product_info_html);

    },
    error: function(xhr, status, error) {
        // Handle errors here
        console.log("Error: " + error);
    }
});

let product_info_html = "";
const showData = (item) => {
    const {description, detail, id, image, link, price, rating, title} = item;

    const rating_as_star = star_html.repeat(rating);
    

    product_info_html = product_info_html.concat(`
    <div id="box">
    <main>
        <style>
            .card {
                background-image: url(${image});
            }
            .info:before {
                background-image: url(${image});
            }
        </style> 
        <div class='card'>
        <div class='info'>
        <h1 class='title'>${title}</h1>
        <p id="ACR" class='description'>
            ${rating_as_star}
        </p>
        <p id="price" class='description'>
            ${parseInt(price).toLocaleString('en-CA', { style: 'currency', currency: 'CAD' })}
        </p>
        <p id="description" class='description'>
            ${detail.slice(0, 200) + '...'}
        </p>
        </div>
        </div>
    </main>
    <div id="item-secondDes">
        <h1 class="product-name"><code>::${title}</code></h1>
        <p class="ACR" >${rating_as_star}<p>
        <p>${parseInt(price).toLocaleString('en-CA', { style: 'currency', currency: 'CAD' })}<p>
        <blockquote>
            <p>${description}</P>
        </blockquote>
    </div>
</div>

    `);


}








