$(document).ready(function () {
    update_amounts();
    wishlistDetails();
    $(".wcf-qty-selection , .price").on("change"),
        function (e) {
            update_amounts();
            wishlistDetails();
        };
});

function update_amounts() {
    var sum = 0.0;
    //   console.log(sum);
    $("#myTable > .product-qty-row").each(function () {
        if ($(this).find("input[type='checkbox']").is(":checked")) {
            var qty = $(this).find(".wcf-qty-selection").val();
            var price = $(this).find(".price").val();
            var amount = qty * price;
            sum += amount;
            let product = JSON.parse($(this).attr("data-options"));
            let index = checkWishlist(product);
            // alert(index);

            if (index != -1) {
                updateWishlist(product, index, qty);
            }
            $(this)
                .find(".amount")
                .text("" + amount);
        } else {
            $(this)
                .find(".amount")
                .text("" + $(this).find(".price").val());
            let products = $(this).attr("data-options");
            // alert(product);
            if (products !== undefined) {
                let product = JSON.parse(products);
                let index = checkWishlist(product);
                // alert(index);

                if (index != -1) {
                    removeToWishlist(product, index);
                }
            }
        }
    });
    $(".total").text(sum);
    wishlistDetails();
}
var incrementQty;
var decrementQty;
var plusBtn = $(".wcf-qty-increment");
var minusBtn = $(".wcf-qty-decrement");
var incrementQty = plusBtn.click(function () {
    // console.log('+');
    var $n = $(this)
        .parent(".wcf-qty-selection-wrap")
        .find("input.wcf-qty-selection");
    //   alert($n.val())
    $n.val(Number($n.val()) + 1);
    update_amounts();
});

var decrementQty = minusBtn.click(function () {
    var $n = $(this)
        .parent(".wcf-qty-selection-wrap")
        .find(".wcf-qty-selection");
    var QtyVal = $n.val();
    //   console.log(QtyVal);
    if (QtyVal > 1) {
        $n.val(QtyVal - 1);
        // console.log($n.val());
    }
    update_amounts();
});

$(".wcf-multiple-sel").click(function () {
    let parent = $(this).closest(".product-qty-row");
    let product = JSON.parse(parent.attr("data-options"));
    let cusQtyNo = parent.find("input.wcf-qty-selection").val();
    // console.log(product);
    // alert(product.product_id);
    //alert(cusQtyNo);

    let wishlist = [];

    if (localStorage.getItem("wishlist") === null) {
    } else {
        wishlist = JSON.parse(localStorage.getItem("wishlist"));
    }

    let index = checkWishlist(product);
    // alert(index);

    if (index == -1) {
        addToWishlist(wishlist, product);
    }
    update_amounts();
    wishlistDetails();
});

function checkWishlist(product) {
    let res = -1;
    if (localStorage.getItem("wishlist") === null) {
        return -1;
    } else {
        //let isVariable = parseFloat($("#isVariable").val()); // has product variation or not
        let wishlistData = JSON.parse(localStorage.getItem("wishlist"));
        let i;
        for (i = 0; i < wishlistData.length; i++) {
            if (wishlistData[i].product_id == product.product_id) {
                res = i;
                break;
            }
        }
    }
    return res;
}

function addToWishlist(wishlist, product) {
    wishlist.push(product);
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
}
function updateWishlist(product, index, cusQtyNo) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist"));

    wishlist[index].cusQty = cusQtyNo;
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
}
function removeToWishlist(product, index) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist"));
    if (product.product_id == wishlist[index].product_id) {
        wishlist.splice(index, 1);
    }
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
}
function wishlistDetails() {
    let totalPrice = 0;
    let totalSubtotal = 0;
    let totalDiscount = 0;
    let withDiscount = 0;
    let wishlistContent = "";

    if (localStorage.getItem("wishlist") === null) {
        $("#cart-total-amount").html(
            '<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>' +
                totalSubtotal
        );
        //alert($(".cart-total-amount").html);
    } else {
        let wishlistData = JSON.parse(localStorage.getItem("wishlist"));

        // $(".wishlist-count").html(wishlistData.length);
        let wishlistNo = 0;
        wishlistData.forEach(function (data) {
            // wishlistContent +=
            //   '<div class="product product-wishlist">' +
            //   ' <div class="product-detail text-left">' +
            //   '     <a href="' +
            //   data.productSlug +
            //   '" class="product-name">' +
            //   data.productName +
            //   "</a>" +
            //   '     <div class="price-box">' +
            //   '         <span class="product-quantity">' +
            //   data.cusQty +
            //   "</span>" +
            //   '         <span class="product-price">Tk ' +
            //   Number(data.discountedPrice).toFixed(2) +
            //   "</span>" +
            //   "     </div>" +
            //   " </div>" +
            //   ' <figure class="product-media">' +
            //   '         <img src="' +
            //   data.cusPhoto +
            //   '" alt="product photo" style="height: 60px; width: 60px;" ' +
            //   " </figure>" +
            //   ' <button class="btn btn-link btn-close btn-remove" cus-product-id="' +
            //   data.productId +
            //   '" wishlist_item_no="' +
            //   wishlistNo +
            //   '" title="Remove Product" aria-label="button">' +
            //   '     <i class="fas fa-times"></i>' +
            //   " </button>" +
            //   " </div>";
            wishlistContent +=
                '<tr class="cart_item">' +
                '<td class="product-name">' +
                '<div class="wcf-product-image"> ' +
                '<div class="wcf-product-thumbnail">' +
                '<img width="50" height="50" src="' +
                data.img +
                '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" />' +
                "</div>" +
                '<div class="wcf-product-name">' +
                data.name +
                "</div>" +
                "</div>" +
                "&nbsp;" +
                '<strong class="product-quantity">×&nbsp;' +
                data.cusQty +
                "</strong>" +
                "</td>" +
                '<td class="product-total">' +
                '<span class="woocommerce-Price-amount amount">' +
                "<bdi>" +
                '<span class="woocommerce-Price-currencySymbol">' +
                "৳&nbsp;" +
                "</span>" +
                data.price * data.cusQty +
                "</bdi>" +
                "</span>" +
                "</td>" +
                "</tr>";

            totalSubtotal += data.price * data.cusQty;
            // totalPrice += data.discountedPrice * data.cusQty;
            // totalDiscount += data.cusDiscount * data.cusQty;
            // wishlistNo += 1;
        });
    }

    $("#cart-subtotal").val(totalSubtotal);
    $("#cart-item").html(wishlistContent);
    $("#cart-total-amount").html(
        '<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>' +
            totalSubtotal
    );
    // let free_shipping = $("#freeShipping").val();

    // if (free_shipping == 1) {
    //     let shipping_charge = 0;
    // }
    // else{
        let shipping_charge = $("#shipping_method")
            .find("input[type='radio']:checked")
            .val();
    // }
    localStorage.setItem("shippingCharge", parseInt(shipping_charge));
    localStorage.setItem("totalSubtotal", totalSubtotal);
    totalPrice = totalSubtotal + parseInt(shipping_charge);
    // console.log(totalPrice);
    $("#total-payment").html(
        '<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>' +
            totalPrice
    );
    $("#place_order").text("Place Order ৳" + totalPrice);
}

$("#place_order").click(function () {
    // if (checkCartItems()){
    // alert("clicked");
    let cartData = JSON.parse(localStorage.getItem("wishlist"));
    if (cartData == null || cartData == "") {
        // alert("Please Select Product First");
        Swal.fire({
            position: "bottom-center",
            icon: "warning",
            title: "Please Select Product First",
            text: "",
            toast: true,
            iconColor: "red",
            showConfirmButton: false,
            showCloseButton: true,
            timer: 4000,
            timerProgressBar: true,
            background: "#ffffff",
            customClass: {
                popup: "bottom-center-toast red-timer-class",
            },
        });
    } else {
        // alert("Cart has product");
        let url = $(this).attr("order-url");
        console.log(url);
        let name = $("#billing_first_name").val();
        let phone = $("#billing_phone").val();
        let size_id = $("#size_id").find("input[type='radio']:checked").val();
        let address = $("#billing_address_1").val();
        // let district = $("#district").val();
        // let order_note = $('#order_note').val()
        let totalSubtotal = JSON.parse(localStorage.getItem("totalSubtotal"));
        let shippingCharge = JSON.parse(localStorage.getItem("shippingCharge"));

        if (
            name !== "" &&
            phone !== "" &&
            address !== "" &&
            size_id !== "" &&
            totalSubtotal !== 0 &&
            shippingCharge !== ""
        ) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: url,
                data: {
                    cartData,
                    name,
                    phone,
                    address,
                    size_id,
                    totalSubtotal,
                    shippingCharge,
                },
                type: "post",
                success: function (data) {
                    // console.log(data);
                    if ($.isEmptyObject(data.error)) {
                        localStorage.clear();
                        wishlistDetails();
                        // checkoutPageDetails();
                        // $(".summary").hide();
                        // $(".orderPlaceBtn").hide();
                        // $(".afterCheckout").hide();
                        if (data.response == false) {
                            localStorage.setItem("checkoutError", 1);
                        }
                        // checkoutSuccessPageDetails();
                        // $(".print-error-msg").find("#message").html("");
                        // $(".print-error-msg").css("display", "block");
                        // $(".print-error-msg")
                        //         .find("message")
                        //         .append("<li> Order Track Id: " + data.orderId + "</li>");
                        Swal.fire({
                            position: "bottom-center",
                            icon: "success",
                            title: "Your OrderTrackId: "+ data.orderId,
                            text: "Your Order Is Successfully Placed",
                            toast: true,
                            iconColor: "green",
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 30000,
                            timerProgressBar: true,
                            background: "#ffffff",
                            customClass: {
                                popup: "bottom-center-toast red-timer-class",
                            },
                        });
                    } else {
                        $(".print-error-msg").find("#message").html("");
                        $(".print-error-msg").css("display", "block");
                        $.each(data.error, function (key, value) {
                            $(".print-error-msg")
                                .find("message")
                                .append("<li>" + value + "</li>");
                        });
                    }
                },
                failed: function () {
                    alert("Something went wrong, Please try again");
                },
            });
        } else {
            // alert("Name, Phone, Shipping Address, Size required");
            Swal.fire({
                position: "bottom-center",
                icon: "warning",
                title: "Name, Phone, Address, Size is required",
                text: "",
                toast: true,
                iconColor: "red",
                showConfirmButton: false,
                showCloseButton: true,
                timer: 4000,
                timerProgressBar: true,
                background: "#ffffff",
                customClass: {
                    popup: "bottom-center-toast red-timer-class",
                },
            });
        }
    }
});


$('input[name="trackOrder"]').on('change', function(){
    var OrderTrackId = $(this).val();
    console.log(OrderTrackId);
    if(OrderTrackId) {
        $.ajax({
            url: 'trackorder/'+OrderTrackId,
            type:"GET",
            data: {
                OrderTrackId,
            },
            dataType:"json",
            success:function(data) {
                $('#orderStatus').attr('placeholder',data.trackStatus);
                $('#orderStatus').attr('value',data.trackStatus);
            },
        });
    }
});


