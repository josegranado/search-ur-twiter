<?php
	declare(strict_types=1);
	include('php/API-Twt.php');
	include ('php/settings.php');
	include ('php/usuario.php');
	use PHPUnit\Framework\TestCase;
	final class Page extends TestCase{
		private $head;
		private $header;
		private $jumbotron;
		private $finish;
		public function testCanBe(){
			$this->head = '<!DOCTYPE html>
							<html lang="en">
							<head>
							  <meta charset="UTF-8">
							  <title>Search Twiter</title>
							  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
							  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
							  <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
							  <link rel="stylesheet" type="text/css" href="css/main.css" />
							  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
							  <script src="js/main.js"></script>
							  <script src="js/jquery-3.2.1.min.js"></script>
							</head>
							<body>';
			$this->header = '<header style="position:fixed;width:100%">
							    <nav id="main-nav" class="navbar navbar-expand-lg navbar-light bg-light" style="">
							    </nav>
							    <div id="logotipo" class="img-logo-brand">
							            <div class="center" style="margin:auto;width:80px;">
							                          <svg id="Logotipo-brand" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px"
							                   height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
							                <g id="Capa_1">
							                  <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M57.75,66"/>
							                  <circle fill="#2A2948" cx="50" cy="49.66" r="48.083"/>
							                  <path fill="none" stroke="#010002" stroke-miterlimit="10" d="M98.08,49.66c0,26.55-21.52,48.08-48.08,48.08S1.92,76.21,1.92,49.66
							                    H98.08z"/>
							                  <path fill="#0A0829" stroke="#010002" stroke-miterlimit="10" d="M96.167,53.833"/>
							                  <rect x="2.333" y="46.333" fill="#292946" width="95.385" height="5.551"/>
							                </g>
							                <g id="Icon">
							                  <path id="Icon-twiter" fill="#FFFFFF" d="M62.939,54.767c2.228-3.647,3.509-7.927,3.509-12.512c0-13.267-10.757-24.031-24.031-24.031
							                    S18.385,28.988,18.385,42.255c0,13.274,10.757,24.031,24.031,24.031c4.539,0,8.789-1.259,12.405-3.448L73.65,81.087l7.965-8.224
							                    L62.939,54.767z M42.302,57.841c-8.667,0-15.693-7.026-15.693-15.693s7.026-15.693,15.693-15.693
							                    c8.667,0,15.693,7.026,15.693,15.693S50.969,57.841,42.302,57.841z"/>
							                  <path id="Icon-Lupa" fill="#FFFFFF" d="M37.486,47.79c-4.31-1.823-3.688-3.647-3.688-3.647h0.995c-3.284-2.155-2.694-4.765-2.694-4.765
							                    l1.409,0.414c-3.025-3.522-0.477-6.133-0.477-6.133s2.134,3.978,9.137,4.931c0,0,0.332-8.826,8.412-4.31l3.057-0.995l-1.275,2.238
							                    l1.958-0.332l-2.29,2.694c-3.149,20.802-21.134,12.556-20.523,11.52C35.414,49.448,37.486,47.79,37.486,47.79z"/>
							                </g>
							                </svg>
							            </div>
							    </div>
							</header>';
			$this->jumbotron = '<div class="jumbotron text-center" style="padding-top:100px;height:800px;">
								  <div class="container" style="padding-top:100px;">
								    <h1>¡BUSCA USUARIOS EN TWITTER!</h1>
								    <p>Nosotros buscamos usuarios en twitter, a través de su API.</p>
								    <form name="Search" action="index.php" method="get" enctype="application/x-www-form-urlencoded" class="search" style="width:45%;margin:auto;background:#FFF;padding:10px;border-radius:5px;color:#000000">
								      <div class="container" style="margin:auto;width:100%">
								        <input name="busqueda" id="busqueda" class="busqueda" required="required" placeholder="Introduce un username..." type="text" style="width:80%;border-radius:10px 0px 0px 10px; padding:5px;float:left"></input>
								      <input id="btn-buscar" type="submit" class="btn btn-success" value="Buscar" style="width:18%;float:left;padding:5px;margin-left:1%">
								      </div>
								    </form>
								  </div>';
			$this->finish = '</div>
								</body>
								</html>';
		}
		public function getHead(){
			return $this->head;
		}
		public function getHeader(){
			return $this->header;
		}
		public function getJumbotron(){
			return $this->jumbotron;
		}
		public function getFinish(){
			return $this->finish;
		}
		public function executeSearch($busqueda){
			$twitter = new TwitterAPIExchange(settings());
			$ObjectResult = json_decode($twitter->setGetfield(createGetField($busqueda))->buildOauth(createUrl(),createRequestMethod())->performRequest(),true);
			if (isset($ObjectResult["errors"])){
				return null;
			}else{
			$Usuario = new Usuario($ObjectResult);
				return $Usuario;
			}
		} 
		public function viewSearch($usuario){
			if ($usuario == null){
				return '<div style="margin: 5px auto;width:45%" class="alert alert-warning" role="alert">
				  No se encontró el usuario, intente de nuevo.
				</div>';
			}else{
			$busqueda = '<div class="busqueda" style="width:45%;margin:5px auto;padding:10px;background:#FFF;color:#000000;overflow:hidden;border-radius:10px">
							<img class="img-circle" style="width:30%;float:left;margin-right:2%" src="'.$usuario->getProfilePic().'" alt="">
							<div class="information" style="float:left;width:65%;font-size:16px;margin-right:1%;text-align:left">
								<ol style="display:block;list-style:none;">
									<li style="margin-top:3px;margin-bottom:3px;width:100%;"><b>Nombre:</b>&nbsp'.$usuario->getNombre().'.</li>
									<li style="margin-top:3px;margin-bottom:3px;width:100%;"><b>Username:</b>&nbsp@'.$usuario->getUsername().'.</li>
									<li style="margin-top:3px;margin-bottom:3px;width:100%;"><b>Ubicación:</b>&nbsp'.$usuario->getLocacion().'.</li>
									<li style="margin-top:3px;margin-bottom:3px;width:100%;"><b>Seguidores:</b>&nbsp'.$usuario->getSeguidores().'.</li>
									<li style="margin-top:3px;margin-bottom:3px;width:100%;"><b>Cuenta creada:</b>&nbsp'.$usuario->getFechaRegistro().'.</li>

								</ol>
								<a href="'.$usuario->getUrl().'"><button class="btn btn-success" style="width:100%">Entrar al perfil</button></a>
							</div>
						</div>';
				return $busqueda;
			}

		}
	}
?>