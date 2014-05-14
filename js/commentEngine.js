$(document).ready(function() {
	$("#comments").html('<h4>Comments</h4><section id="ce_list"></section><form id="ce_form" method="post"><label for="ce_title">Title:</label><input type="text" id="ce_title" name="ce_name"><label for="ce_comment">Comment:</label><textarea id="ce_comment" name="ce_comment" cols="30" rows="10"></textarea><input type="submit" value="Add Comment"></form>');

	$("#ce_form").submit(function() {
		ceAddComment();
		return false;
	});

	ceLoadComments();
});

function ceLoadComments() {
	$.ajax({
		url: "ce/loadComment.php",
		dataType: "json",
		success: function(data) {

			$("#ce_list").html("<ul></ul>");

			$.each(data, function() {
				$("#ce_list ul").append(
					"<li><h5>" + 
					this.title + 
					"</h5><p>" +
					this.comment +
					"</p><time datetime='" + 
					this.date +
					"'>" + 
					this.pubdate + "</time></li>"
				);
			});

			$("#ce_title, #ce_comment").val("");
		}
	});
}

function ceAddComment() {
	$.ajax({
		data: {
			title: $("#ce_title").val(),
			comment: $("#ce_comment").val()
		},
		url: "ce/addComment.php",
		dataType: "json",
		success: function(data) {
			console.log(data);
			ceLoadComments();
		}
	});
}