<?php 
	include("php/page.php");
	$page = new Page();
	print $page->getHead();
	print $page->getHeader();
	print $page->getJumbotron();
	if (isset($_GET['busqueda'])){
		print $page->viewSearch($page->executeSearch($_GET['busqueda']));
	}
	print $page->getFinish();
?>