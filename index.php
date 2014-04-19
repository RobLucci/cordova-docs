<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/global.css">
	<title>Uploader</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->    
	<script src="js/jquery-1.11.0.min.js"></script>
	<!-- Include all compiled Bootstrap plugins -->
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<h1>Upload File</h1>
	<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Carica una immagine</button>

	<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
 		<div class="modal-dialog modal-sm">
    		<div class="modal-content">    

				<!-- modal content -->
				<form action="upload.php" method="post" enctype="multipart/form-data" id="upload" class="upload">
					<fieldset>
						<legend>Upload files</legend>
						<input type="file" id="file" name="file[]" required >
						<input type="submit" id="submit" name="submit" value="Upload">
					</fieldset>	

					<div class="bar">
						<span class="bar-fill" id="pb">
							<span class="bar-fill-text" id="pt"></span>
						</span>
					</div>

					<div id="uploads" class="uploads"></div>

					<script type="text/javascript" src="js/upload.js"></script>
					<script type="text/javascript">

					document.getElementById("submit").addEventListener("click", function(e){
						e.preventDefault();
						var f = document.getElementById("file");
						var pb = document.getElementById("pb");
						var pt = document.getElementById("pt");

						app.uploader({
							files : f,
							progressBar : pb,
							progressText : pt,
							processor: "upload.php",

							finished : function(data){

								var uploads = document.getElementById("uploads");
								var succedeed = document.createElement("div");
								var failed = document.createElement("div");

								var anchor;
								var span;
								var x;

								if(data.failed.length){
									failed.innerHTML = "<p>Il seguente file non è stato caricato:</p>";
								}

								if(data.succedeed.length){
									succedeed.innerHTML = "<p>Il seguente file è stato caricato con successo!</p>";
								}

								uploads.innerText = "";

								for(x=0;x<data.succedeed.length;x++){
									anchor = document.createElement("a");
									anchor.href = "uploads/"+data.succedeed[x].file;
									anchor.innerText = data.succedeed[x].name;
									anchor.target = "_blank";

									succedeed.appendChild(anchor);
								}

								for(x=0;x<data.failed.length;x++){
									span = document.createElement("span");
									span.innerText = data.failed[x].name;

									failed.appendChild(span);
								}

								uploads.appendChild(succedeed);
								uploads.appendChild(failed);
							},
							error : function(){
								console.log("errore");
							}
						});
					});						
					</script>
				</form>
				<!-- end modal content -->
    		</div>
  		</div>
	</div>	
</body>
</html>