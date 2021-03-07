
function checkLocation(needLocation) {
    return window.location.pathname.substr(0, needLocation.length) == needLocation ;
}
function checkLocationByRegEx(needLocationPattern) {
    return window.location.pathname.match( new RegExp(needLocationPattern) );
}



if( checkLocation('/register') ) {
    require('./scripts/register/captcha');
}

if( checkLocation('/product/photo/editList') ) {
    require('./scripts/product_photo/editPositionsForProduct/sortable');
}

// let rEv4 = new RegExp(/^\/product\/[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i);
if( checkLocationByRegEx(/^\/product\/[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i) ) {
    require('./scripts/product/show/addToCart');
    require('./scripts/product/show/changeQuantity');
}

if( checkLocationByRegEx(/^\/product\/[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}\/edit$/i)
    || checkLocation('/product/create') ) {
    require('./scripts/product/checkInputPrices.js');
    require('./scripts/product/show/changeQuantity');
}

// if( window.location.pathname.match(new RegExp(/^\/cart$/i)) ) {
if( checkLocation('/cart') ) {
    require('./scripts/cart/removeFromCart');
    require('./scripts/cart/changeQuantity');
    require('./scripts/cart/checkout');
}
