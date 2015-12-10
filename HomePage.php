<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>

	<link href="HomePageStyle.css" rel="stylesheet">
	<link href="navbar.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <!-- jQuery 1.11 CDN -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> <!-- Bootstrap JS CDN -->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"><!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<?php
		include("getApproved.php");
	?>
    <script type="text/javascript">
	    $(document).ready(function(event){

	    	$('[data-toggle="popover"]').popover();

	    	$("#createListSubmitBtn").click(function(event){

	    		event.preventDefault();

	    		var d = new Date();

				var month = d.getMonth()+1;
				var day = d.getDate();

				var date = d.getFullYear() + '/' +
				    (month<10 ? '0' : '') + month + '/' +
				    (day<10 ? '0' : '') + day;

				var listName = $("#createListNameInput").val();

	    		$.ajax({
	    			url: 'create.php',
	    			type: 'post',
	    			data: {'action': 'createList', 'date': date, 'listName': listName},
	    			success: function(data){
	    				//$("#listContent").load("loadLists.php");
	    					location.reload();
	    					$("#createListNameInput").val('');
	    				
	    			},
	    			error: function(xhr, desc, err){
	    				alert("AJAX Failed");
	    			}
	    		});
	    	});

			$(".addItemBtn").on("click", function(event){
				event.preventDefault();

				var list = $(this).closest("div");
				var listId = list.attr("id");
				
				var priority = listId + "-priority";
				var itemPriority = $("#"+priority).val();
				

				var pos = 0;

				if(itemPriority == "Low"){
					pos = 3;
				}
				else if (itemPriority == "Med"){
					pos = 2;
				}			
				else if (itemPriority == "High"){
					pos = 1;
				}	

				var inputId = listId + "-input";
				var itemName = $("#"+inputId).val();
				
				$.ajax({
					url: 'addItem.php',
					type: 'post',
					data: {'action': 'addItem', 'itemName': itemName, 'listId': listId, 'pos': pos, 'itemPriority': itemPriority},
					success: function(data){
						
						location.reload();
					},
					error: function(xhr, desc, err){
						alert("failed to add");
					}

				});

			});

			$(".approveBtn").on("click", function(event){
				event.preventDefault();

				

				var list = $(this).closest("div");
				var listId = list.attr("id");
				

				var inputName = listId + "-approve";
				var userName = $("#"+inputName).val();
				

				var name = $(this).closest("listbtn");
				var listName = name.attr("id");
				

				$.ajax({
					url: 'approveUser.php',
					type: 'post',
					data: {'action': 'approve', 'user': userName, 'listId': listId, 'listName': listName},
					success: function(data){
						
						location.reload();
					},
					error: function(xhr, desc, err){
						alert("failed to add");
					}

				});

			});

			$(".deleteListBtn").on("click", function(event){
				event.preventDefault();

				

				var list = $(this).closest("div");
				var listId = list.attr("id");
				

				$.ajax({
					url: 'deleteList.php',
					type: 'post',
					data: {'action': 'deleteList', 'listId': listId},
					success: function(data){
						
						location.reload();
					},
					error: function(xhr, desc, err){
						alert(err);
					}

				});

			});    	

		 });
    </script>
</head>
<body>

<div class="container">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Listify</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
  	</nav>

	
		<div class="row">
			<div class="jumbotron">
				<h1>Create A New List</h1>
				<p>Enter a name for your list, or leave it blank to make the name the current date</p>
			</div>	<!-- End Jumbotron -->
		</div>
		<div class="row">
			<form id ="createListForm">
				<label for="createListNameInput">List Name:</label>
				<input type="text" class="form-control" id="createListNameInput">
				<button type="button" class="btn my-btn btn-lg btn-primary" id="createListSubmitBtn">Create New List &raquo;</button>
			</form>
		</div>
		<div class="row">
			<div class="col-xs1-12" style="text-align: center">
				<h1>Your Lists</h1>
				<hr>
			</div>
		</div>
		<div id="listContent">
			<?php include('loadLists.php') ?>
		</div>		
	</div><!-- End Container
</body>
</html>