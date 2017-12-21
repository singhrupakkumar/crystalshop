$(document).ready(function(){

	$('.numeric1').on('keypress', function(event) {
		if (event.keyCode == 13) {
			return true;
		}
		return (/\d/.test(String.fromCharCode(event.keyCode)));
	});

	$('.numeric').on('keyup change', function(event) {

		var quantity = Math.round($(this).val());

		if ((event.keyCode == 46 || event.keyCode == 8) && quantity > 0) {
		} else {
			if(/\d/.test(String.fromCharCode(event.keyCode)) === false) {
				return false;
			}
		}

		ajaxcart($(this).attr("data-id"), quantity, $(this).attr("data-mods"));

	});

	$(".remove").each(function() {
		$(this).replaceWith('<a class="remove" id="' + $(this).attr('id') + '" href="http://rupak.crystalbiltech.com/crystal/stores/remove/' + $(this).attr('id') + '" title="Remove item"><img src="http://rupak.crystalbiltech.com/crystal/img/delete-icon.png" alt="Remove" /></a>');
	});

	$(".remove").click(function() { 
		ajaxcart($(this).attr("id"), 0);
		return false;
	});

	function ajaxcart(id, quantity, mods) {

		if(quantity === 0) {
			$('#row-' + id).fadeOut(1000, function(){ $('#row-' + id).remove(); });
		}

		$.ajax({
			type: "POST",
			url:"http://rupak.crystalbiltech.com/crystal/stores/itemupdate",
			data: {
				id: id,
				mods: mods,
				quantity: quantity
			},
			dataType: "json",
			success: function(data) {  
				$.each(data.OrderItem, function(key, value) {
					if($('#subtotal_' + key).html() != value.subtotal) {
						$('#ProductQuantity-' + key).val(value.quantity);
						$('#subtotal_' + key).html(value.subtotal).animate({ backgroundColor: "#ff8" }, 100).animate({ backgroundColor: "#fff" }, 500);
					}
				});
				$('#subtotal').html('$' + data.Order.total).animate({ backgroundColor: "#ff8" }, 100).animate({ backgroundColor: "#fff" }, 500);
				$('#total').html('$' + data.Order.total).animate({ backgroundColor: "#ff8" }, 100).animate({ backgroundColor: "#fff" }, 500);
				if(data.Order.total === 0) {
                                     alert('0')
					//window.location.replace("http://rupak.crystalbiltech.com/crystal/stores/clear");
				}
			},
			error: function() {
                            alert('big')
				//window.location.replace("http://rupak.crystalbiltech.com/crystal/stores/clear");
			}
		});
	}

});
