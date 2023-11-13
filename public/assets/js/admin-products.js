// Mise à jour du prix remisé
function updatePriceDiscount(){

    var price = $('#product_form_price').val();
    var discount = $('#product_form_discount').val();
    var priceDiscountDiv = $('#product_form_price_help');
    var priceDiscountText = $('#product_form_price_discount');
    
    // calcule le prix remisé remise
    var priceDiscount = price - (price*discount/100);
    // met en forme la remise
    priceDiscountText.text((priceDiscount).toFixed(2));
    
    // Montrer le prix remisé que s'il y a une remise valable
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

    // Initialiser l'affichage des champs remise s'il y a une remise
    if (discount == 0) {
        hiddenInput.hide();
        toggle = false;
    } else {
        hiddenInput.show();
        toggle = true;
    }

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

    $('#btDiscount').click(function() {
        displayDiscountInput();
    });

    $('#product_form_discount').on('keyup change', function(){
        updatePriceDiscount ();
    });

    $('#product_form_price').on('keyup change', function(){
        updatePriceDiscount ();
    });

});