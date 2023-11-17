// Mise à jour du prix remisé
function updatePriceDiscount(){

    var price = $('#product_form_price').val();
    var discount = $('#product_form_discount').val();
    var priceDiscountDiv = $('#product_form_price_help');
    var priceDiscountText = $('#product_form_price_discount');
    
    // calculate price with discount
    var priceDiscount = price - (price*discount/100);
    // format price with discount with 2 decimal
    priceDiscountText.text((priceDiscount).toFixed(2));
    
    // if product discount is live show price with discount
    if ((priceDiscount <= 0 || discount <= 0) && (discount != 100) || (price == 0)) {
        priceDiscountDiv.hide();
    } else if (isNaN(priceDiscount)) {
        priceDiscountDiv.hide();        
    } else {
        priceDiscountDiv.show();
    }
}

$(document).ready(function(){

    var discount = $('#product_form_discount').val();
    var hiddenInput = $('#product_form_hidden_input_discount');
    var toggle = false;

    // discount inputs display init
    if (discount == 0) {
        hiddenInput.hide();
        toggle = false;
    } else {
        hiddenInput.show();
        toggle = true;
    }
    // discount inputs display
    function displayDiscountInput() {
        var button = document.getElementById("btDiscount");
        var discountInput = $('#product_form_discount');
        var discountStartInput = $('#product_form_discount_start');
        var discountEndInput = $('#product_form_discount_end');
    
        if(toggle == false) {
            button.innerHTML = "<i class=\"bi bi-patch-plus-fill h6\" ></i> Promotion";
            button.classList.remove("btn-outline-secondary");
            button.classList.add("btn-outline-danger");
    
            discountInput.val("0");
            discountStartInput.val("");
            discountEndInput.val("");
    
            updatePriceDiscount ();
    
            hiddenInput.hide();
    
            toggle = true;
        } else {
            button.innerHTML = "<i class=\"bi bi-x-square-fill\"></i> Retirer la promotion";
            button.classList.remove("btn-outline-danger");
            button.classList.add("btn-outline-secondary");
    
            hiddenInput.show();
    
            toggle = false;
        }
    }

    displayDiscountInput();
    updatePriceDiscount ();
    // discount inputs display on click on discount button
    $('#btDiscount').click(function() {
        displayDiscountInput();
    });
    // update price with discount when discount input value change
    $('#product_form_discount').on('keyup change', function(){
        updatePriceDiscount ();
    });
    // update price with discount when discount input value change
    $('#product_form_price').on('keyup change', function(){
        updatePriceDiscount ();
    });

});