var ManagerModal = {
	selector: "",
	title: "",
	config: function(selector, title) {
		this.selector = selector;
		this.title    = title;
	},
	show: function(typeModal, message) {
		switch (typeModal) {
			case 'default':
			$(this.selector + ' .modal-body').html("<p>" + message + "<p>");
			$(this.selector).removeClass('modal-danger');
			$(this.selector + ' .btn').removeClass('btn-outline');
			$(this.selector + ' .btn').addClass('btn-primary');
			break;
			case 'danger':
			$(this.selector + ' .modal-body').html("<p>" + message + "<p>");
			$(this.selector).addClass('modal-danger');
			$(this.selector + ' .btn').addClass('btn-outline');
			$(this.selector + ' .btn').removeClass('btn-primary');
			break;
		}
		$(this.selector).modal('show');
	}
}; 