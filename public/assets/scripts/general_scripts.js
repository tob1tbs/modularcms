function ViewNotification(notification_id) {
	$.ajax({
        dataType: 'json',
        url: "/main/ajax/notification/view",
        type: "GET",
        data: {
        	notification_id: notification_id,
        },
        success: function(data) {
            if(data['status'] == true) {
            	
            }
        }
    });
}

function ViewAllNotification() {
	
}