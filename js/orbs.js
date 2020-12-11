function validate_input() {
	customer_name = $("#name").val();
	customer_email = $("#email").val();
	customer_address = $("#address").val();
	customer_phone = $("#phone").val();

	if($name != "" && $email != "" && $address != "" && $phone != "") {
		$.ajax({
			url: 'process_order.php',
			type: 'post',
			data: {order_info: 'info', name: customer_name, email: customer_email, address: customer_address, phone: customer_phone},
			success: function(data) {
				if(data == 'success') {
					window.location = 'order_summary.php';
				} else {
					alert(data);
				}
			}
		});
	} else {
		alert('Incomplete form data');
	}
}