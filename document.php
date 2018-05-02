<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Solicitations</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">


	<!--file upload-->

	<!-- Generic page styles -->
	<link rel="stylesheet" href="jQuery-File-Upload-9.21.0/css/style.css">
	<!-- blueimp Gallery styles -->
	<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="jQuery-File-Upload-9.21.0/css/jquery.fileupload.css">
	<link rel="stylesheet" href="jQuery-File-Upload-9.21.0/css/jquery.fileupload-ui.css">
	<!-- CSS adjustments for browsers with JavaScript disabled -->
	<noscript><link rel="stylesheet" href="jQuery-File-Upload-9.21.0/css/jquery.fileupload-noscript.css"></noscript>
	<noscript><link rel="stylesheet" href="jQuery-File-Upload-9.21.0/css/jquery.fileupload-ui-noscript.css"></noscript>
	<!--file upload-->


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>

</head>
<body>
	<?php require_once('submit.php'); ?>
	
	<div id="wrapper" class="container">

		<div class="container-fluid" id="header">
			<img src="download.png" height="45">
		</div>
		<div class="container-fluid" id="heading">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#"><h4>Bid Opportunities Admin</h4></a>
						</li>

						<li class="nav-item active">
							<a class="nav-link" href="solicitations.php"><i class="fa fa-money" aria-hidden="true"></i>	Solicitations</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="email.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> Emails</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="bidder.php?listType=Bidders"><i class="fa fa-users" aria-hidden="true"></i> Bidders</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="bidder.php?listType=Users"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
						</li>

					</ul>
					<ul style="float: right;">
						<li class="nav-item dropdown" >
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $_SESSION["username"]; ?><i class="fa fa-caret-down" aria-hidden="true"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="home.php">Logout</a>
								<!--<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>-->
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="container-fluid" id="solicitation">
			<div class="container-fluid" id="solicitation-header">
				<h2><i class="fa fa-money" aria-hidden="true"></i>	<?php echo $_GET['type'] ?> Solicitation</h2>				
			</div>
			<div class="container-fluid" id="create-solicitation">
				<?php 
				if(isset($_POST["createsolicitation"])){
					
					createsolicitation();
				}
				if(isset($_GET["cansid"])){
					cancelSolicitation($_GET["cansid"]);
				}
				if(isset($_GET["pubsid"])){
					publishSolicitation($_GET["pubsid"]);
				}
				?>
				<form action="document.php?type=Update&sid=<?php echo $_SESSION['sid']; ?>" method="post" name="createsolicitation">
					<div class="col-sm-6">
						<?php 
						if(isset($_GET["msg"]))
						{	
							echo "<font color='green'>".$_GET["msg"]."</font><br>";
						}

						?>
						Number <span class="req">(required)</span><br>
						<input type="text" placeholder="2018-" name="snumber" id="snumber" required><br>
						<p style="color:#a8a8a8;">Use numbers only. Example: 2018-1111</p><br>

						Final Filing Date/Time <span class="req">(required)</span>
						<input type="datetime-local" name="sfinalfiling" id="sfinalfiling" value="<?php echo date('Y-m-d').'T15:00'; ?>" required><br><br>

						Type <span class="req">(required)</span><br>
						<select class="form-control" name="stype" id="stype">
							<option value="solicitation">Solicitation</option>
							<option value="cn">Competitive Negotiation (CN)</option>
							<option value="ifb">Invitation for Bid (IFB)</option>
							<option value="rfp">Request for Proposals (RFP)</option>
						</select>

						<br>

						Category <span class="req">(required)</span><br>

						<select class="form-control" name="scategory" id="scategory">
							<option value="it" >Information Technology</option>
							<option value="pscc" >Personal Services and Consulting Contracts</option>

						</select>


					</div>
					<div class="col-sm-6">
						Title <span class="req">(required)</span> <br>
						<input type="text" name="stitle" id="stitle" required><br>
						<p style="color:#a8a8a8;">Use Title Case.</p><br>
						<br>
						Description <span class="req">(required)</span> <br>

						<textarea id="summernote" name="editordata" style="height: 100px;" required></textarea>

					</div><br>
					<button type="submit" id="submit" name="createsolicitation" class="btn btn-primary" style="border-radius: 0;float:left;margin-right:5px;"><i class="fa fa-floppy-o" aria-hidden="true" style="color: white; "></i> Save</button> 
				</form> 
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#upload-document" id="upbtn" style="border-radius: 0;"><i class="fa fa-upload" aria-hidden="true"></i>  Upload Documents</button>

				<a href="document.php?pubsid=<?php echo $_SESSION['sid']; ?>" ><button type="button" class="btn btn-success" id="PublishSolicitation" style="border-radius: 0;"><i class="fa fa-check" aria-hidden="true"></i> Publish Solicitation</button></a>

				<a href="document.php?cansid=<?php echo $_SESSION['sid']; ?>" ><button type="button" class="btn btn-danger" id="cancelSolicitation" style="border-radius: 0;"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Cancel Solicitation</button></a>

				<button type="reset" class="btn btn-default" style="border-radius: 0;" onclick="openPage('solicitations.php')">Cancel</button>



				<!-- Modal -->
				<div class="modal fade" id="upload-document" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Documents</h4>
							</div>
							<div class="modal-body">

								<ul class="nav nav-tabs">
									<li class="active" id='editli'><a data-toggle="tab" href="#edit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</a></li>
									<li id='viewli'><a data-toggle="tab" href="#view">View</a></li>
								</ul>

								<div class="tab-content">
									<div id="edit" class="tab-pane fade in active">					
										<form action="upload.php" method="post" enctype="multipart/form-data">
											<br>
											<br><br>
											<br><br>
											<b>Select One or More Files</b>
											<input type="file" id="files" name="files[]" multiple/>
											<output id="list"></output>

											<script>
												function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
    	output.push('<tr><td><strong>', escape(f.name), '</strong> </td> <td>',
    		f.size, ' bytes</td><td>',
    		f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
    		'</td><td><input type="date" name="d'+i+'" style="width:150px;"></td><td>'+
    		'<button type="button" class="btn btn-danger" id="delete"><i class="glyphicon glyphicon-trash"></i> Delete</button> '+
    		'</td></tr>');
    }
    document.getElementById('list').innerHTML = "<table class='table table-striped table-bordered'><thead><th>File Name</th><th>File Size</th><th>Last modified</th><th>Set Due Date</th><th>Edit Options</th></thead>" + output.join('') + "</table> <button type='submit' name='up' class='btn btn-primary'> <i class='glyphicon glyphicon-upload'></i> Start Upload </button>";
    $('#delete').click(function(e){
    	$(this).closest('tr').remove();
    });
}

document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>									
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>


</form>
</div>
<div id="view" class="tab-pane fade">
	<h3>List of Documents:</h3>
	<br>
	
	
	<?php viewAllDocument(); 

	if(isset($_GET['delid'])){
		deletefile($_GET['delid']);
		header('Location: document.php?type=Update&sid='.$_SESSION['sid']);
	}

	?>
	


</div>
</div>


</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

<!--<button type="submit" class="btn btn-danger" style="border-radius: 0;" onclick="openPage('solicitations.php')">Cancel</button>-->


</div>
</div>
</div>
<?php if(isset($_GET['sid'])){
	$_SESSION['sid']=$_GET['sid'];
	updatesolicitation($_REQUEST['sid'],0);

}?>				
<?php 
if(isset($_GET['dsid'])){
	$_SESSION['sid']=$_GET['dsid'];
	updatesolicitation($_REQUEST['dsid'],1);

}
?>
<script>
	$(document).ready(function() {
		$('#summernote').summernote({
			height:200,
			focus:true
		});
	});
</script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-upload fade">
		<td>
			<span class="preview"></span>
		</td>
		<td>
			<p class="name">{%=file.name%}</p>
			<strong class="error text-danger"></strong>
		</td>
		<td>
			<p class="size">Processing...</p>
			<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
		</td>
		<td>
			{% if (!i && !o.options.autoUpload) { %}
			<button class="btn btn-primary start" disabled>
				<i class="glyphicon glyphicon-upload"></i>
				<span>Start</span>
			</button>
			{% } %}
			{% if (!i) { %}
			<button class="btn btn-warning cancel">
				<i class="glyphicon glyphicon-ban-circle"></i>
				<span>Cancel</span>
			</button>
			{% } %}
		</td>
	</tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-download fade">
		<td>
			<span class="preview">
				{% if (file.thumbnailUrl) { %}
				<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
				{% } %}
			</span>
		</td>
		<td>
			<p class="name">
				{% if (file.url) { %}
				<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
				{% } else { %}
				<span>{%=file.name%}</span>
				{% } %}
			</p>
			{% if (file.error) { %}
			<div><span class="label label-danger">Error</span> {%=file.error%}</div>
			{% } %}
		</td>
		<td>
			<span class="size">{%=o.formatFileSize(file.size)%}</span>
		</td>
		<td>
			{% if (file.deleteUrl) { %}
			<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
				<i class="glyphicon glyphicon-trash"></i>
				<span>Delete</span>
			</button>
			<input type="checkbox" name="delete" value="1" class="toggle">
			{% } else { %}
			<button class="btn btn-warning cancel">
				<i class="glyphicon glyphicon-ban-circle"></i>
				<span>Cancel</span>
			</button>
			{% } %}
		</td>
	</tr>
	{% } %}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="jQuery-File-Upload-9.21.0/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="jQuery-File-Upload-9.21.0/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="jQuery-File-Upload-9.21.0/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script src="js/custom.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>




</body>
</html>
