$(document).ready(function() {
    Stripe.setPublishableKey("pk_test_kjS90aGf8l4ydIcYNbcRifjZ");

    $("#buykey button").on("click", function(event) {
        var form = $("#buykey");
        var submit = form.find("button");
        var subText = submit.text();

        submit.attr("disabled", "disabled").text("One moment please...");

        Stripe.card.createToken(form, function(status, response) {
            if (response.error) {
                console.log("there was an error");
                console.log(response.error);
                form.find(".stripe-errors")
                    .text(response.error.message)
                    .show();
            } else {
                form.append(
                    $('<input type="hidden" name="token">').val(response.id)
                );
                form.submit();
            }
        });
    });
});
