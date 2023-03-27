const showPagination = (pageNum) => {
    let pagination_html = "";
            if(pageNum == 1) {
                pagination_html = pagination_html.concat(`
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">1</a>
                </li>
                `);
            }else {
                pagination_html = pagination_html.concat(`
                <li>
                    <a class="nav__page_previous" href="#" aria-label="Previous">
                        <span>&laquo; Prev</span>
                    </a>
                </li>
                `)
                if(pageNum ==2) {
                    for(let i = 0; i < pageNum; i++) {
                        if(currentPage == i+1) {
                            pagination_html = pagination_html.concat(`
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link currentPage" id="${currentPage}">${i+1}</a>
                            </li>
                            `);
                        }else {
                            pagination_html = pagination_html.concat(`
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link">${i+1}</a>
                            </li>
                            `);
                        }
                    }

                }else if(pageNum >= 3) {
                    if(currentPage == 1 || currentPage == pageNum) {
                        pagination_html = pagination_html.concat(`
                        <li class="nav__page_item">
                            <a href="#" class="nav__page_link ${currentPage == 1? "currentPage":""}" ${currentPage == 1? `id="${currentPage}"`:""}>1</a>
                        </li>
                        <li class="nav__page_item">
                            <a href="#" class="nav__page_link">...</a>
                        </li>
                        <li class="nav__page_item">
                            <a href="#" class="nav__page_link ${currentPage == pageNum? "currentPage":""}" ${currentPage == pageNum? `id="${currentPage}"`:""}>${pageNum}</a>
                        </li>
                        `);
                    }else {

                        if(pageNum == 3) {
                            pagination_html = pagination_html.concat(`
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link">1</a>
                            </li>
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link currentPage" id="${currentPage}"}>${currentPage}</a>
                            </li>
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link">${pageNum}</a>
                            </li>
                            `);
                        }else if (pageNum >= 4) {
                            if(currentPage == 2) {
                                pagination_html = pagination_html.concat(`
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">1</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">${currentPage}</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">${pageNum}</a>
                                </li>
                                `);
                            }else if (currentPage == pageNum - 1) {
                                pagination_html = pagination_html.concat(`
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">1</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">${currentPage}</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">${pageNum}</a>
                                </li>
                                `);
                            }else {
                                pagination_html = pagination_html.concat(`
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">1</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">${currentPage}</a>
                                </li>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">${pageNum}</a>
                                </li>
                                `);
                            }
                        }
                    }
                    

                }
                pagination_html = pagination_html.concat(`
                    <li>
                        <a class="nav__page_next " href="#" aria-label="Next">
                            <span>Next &raquo;</span>
                        </a>
                    </li>
                `)
            }
            pagination_html = pagination_html.concat(`
                <style>
                    .currentPage{
                        color: red;
                        font-weight: 900;
                    }
                </style>
            `)


            $(".nav__pagination").html(pagination_html);
            $(".nav__page_link").click((e) => {
                const text = $(e.target).text();
                console.log(text);
                if(text != "...") {
                    currentPage = text;
                    asyncItems(search, $('#order').val(), currentPage);
                }
            })
            $(".nav__page_next").click(() => {
                console.log("next");
                if(currentPage < pageNum) {
                    currentPage++;
                    asyncItems(search, $('#order').val(), currentPage);
                }
            });
            $(".nav__page_previous").click(() => {
                if(currentPage > 1) {
                    currentPage--;
                    asyncItems(search, $('#order').val(), currentPage);
                }
            });
}


const onClickPage = () => {

}

// let productInfo = {
//     id: 1,
//     ACR: 5,
//     productImg: `../img/iPhone13.png`,
//     productName: `Iphon13`,
//     productPrice: '1600',
//     productDes: `
//     The iPhone 13 has a 6.1-inch screen, and the iPhone 13 mini has a 5.4-inch screen. They both use Apple's Ceramic Shield cover glass, which adds improved drop protection. The Super Retina XDR display is 28% brighter up to 800 nits for regular content 1200 nits for HDR.
//     `,
//     opinion: opinions.slice(0,3)
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

//     if(key == 'opinion') {
//         productInfo[key] = productInfo[key].map(i => i.length > limit? i.slice(0,limit) + '...': i);
//         return;
//     }

//     productInfo[key] = 
//     productInfo[key].length > limit? 
//     productInfo[key].slice(0, limit) + '...':productInfo[key];
// });

// const {id, ACR, productImg, productName, productPrice, productDes, opinion} = productInfo;



let totalPage;
const offset = 4;
let currentPage = 1;
let pageNum;


let order = 0;

$("#orderButton").click((e) => {
    e.preventDefault();

    currentPage = 1;
    asyncItems(search, $('#order').val());


})
////////////////////////////////////////////////////////////////////////
const getItemNum = (search="") => {
    $.ajax({
        url: "../database/items.php",
        type: "GET",
        dataType: "json",
        data: {
            search: search,
            getNum: 1,
        },
        success: function(response) {
            totalPage = response;
            pageNum = Math.ceil(totalPage/offset);
            console.log(pageNum);
            showPagination(pageNum);
            


        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.log("Error: " + error);
        }
    });
}
////////////////////////////////////////////////////////////////////////////
const asyncItems = (search = "", order, page=1) => {

    $.ajax({
        url: "../database/items.php",
        type: "GET",
        dataType: "json",
        data: {
            search: search,
            order: order,
            page: page

        },
        success: function(response) {
            // Update the HTML with the fetched data
            
            productItem_html = "";
            $(".item_list").html("");
            showData(response);
            showPagination(pageNum);
    
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.log("Error: " + error);
        }
    });
}


if(typeof search === "undefined") {
    search = false;
}

if(!search) {
    getItemNum("");
    asyncItems("", order);
} else {
    getItemNum(search);
    asyncItems(search, order);
}







const showData = (items) => {

    const promises = [];

    for(let i = 0; i < items.length; i++) {
        const promise = $.ajax({
            url:  "../database/opinions.php",
            type: "GET",
            dataType: "json",
            data: {
                itemId: items[i].id
            }
        });
        
        promises.push(promise);
    }

    Promise.all(promises)
        .then(responses => {
            for(let i = 0; i < responses.length; i++) {
                makeHtml(items[i], responses[i]);
            }

            $(".item_list").html(productItem_html);
        })
        .catch(error => {
            console.log("Error receiving other data", error);
        });

}



let productItem_html ='';
const makeHtml = (item, opinions) => {
    const limit = 140;
    let truncatedReview = opinions.map(i => i.review.length > limit? i.review.slice(0,limit) + '...': i.review);
    let {description, detail, id, image, link, price, rating, title} = item;

    rating_as_star = star_html.repeat(rating);
    
    productItem_html = productItem_html.concat(`
    <div id=${`product`+id} class="item_box d-flex gap-4 flex-column flex-lg-row flex-grow-1">
<div class="item_box__des d-flex gap-4 flex-column flex-sm-row">
    <div class="item_box__des__img_frame">
        <img src="${image}" alt="img">
    </div>
    <div class="item_box__des_info pt-2 pt-md-4" >
        <ul class="item_box__des_info__ul p-0 gap-2">
            <li id="productRating" class="item_box__info__ul__item" value="price">
                ${rating_as_star}
            </li>
            <li id="productName" class="item_box__info__ul__item" value="name">
                ${title} 
            </li>
            <li id="productPrice" class="item_box__info__ul__item" value="price">${parseInt(price).toLocaleString('en-CA', { style: 'currency', currency: 'CAD' })}</li>
            <li id="productDescription" class="item_box__info__ul__item" value="description">
                ${user.user?detail: "Need to sign in to see description "}
            </li>
        </ul>
        <button class="item_box__button link" data-link="${link}">Buy</button>
    </div>
</div>
<div class="item_box__opinion pt-2 pt-md-4">
    <h5 style="padding-left:1rem; text-decoration: underline;">Review</h5>
    <ul class="item_box__opinion__ul gap-4">
        <li class="item_box__opinion__ul__item">
            ${truncatedReview[0]?truncatedReview[0]:''}
        </li>
        <li class="item_box__opinion__ul__item">
            ${truncatedReview[1]?truncatedReview[1]:''}
        </li>
        <li class="item_box__opinion__ul__item">
            ${truncatedReview[2]?truncatedReview[2]:''}
        </li>
    </ul>
    <button class="item_box__button opinion">More opinion</button>
</div>
</div>
    `);
    
    
}



/////////////////////////////////////////////////////////////////////////////


$(document).on("click", ".item_box__button.opinion", function() {
    if(!user.user) {
        window.location.href = "./login.php";

    }else {
        // Get the id of the clicked product using the closest() and attr() methods
        let id = $(this).closest(".item_box").attr("id");

        // Redirect to the product page with the id in the URL
        window.location.href = "./product.php?id="+id.slice(7);
    }
    
}).on("click", ".item_box__button.link", function() {
    var link = $(this).data("link");
    window.location.href = link;
});











