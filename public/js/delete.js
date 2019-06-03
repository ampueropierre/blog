(function($){
	function deleteModel(model){
		$('.delete-' + model).click(function(e) {
			e.preventDefault();
			var url = $(this).attr('href');
			var tr = $(this).closest('tr');
			$.ajax({
				url: url,
				// type: 'default GET (Other values: POST)',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			})
			.done(function() {
				console.log("success");
				tr.fadeOut(1000, function() {
					tr.remove();
				});
			})
			.fail(function() {
				console.log("error");
			});	
		});
	}

	deleteModel('user');
	deleteModel('post');
	deleteModel('comment');
	
})(jQuery);
