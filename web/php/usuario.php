<?php 
	
	class Usuario{
		public $profilePic;
		public $username;
		private $nombre;
		private $locacion;
		private $url;
		private $fechaRegistro;
		public $seguidores;
		public function __construct($user_information)
		{
			$this->profilePic = $user_information["profile_image_url"];
			$this->username = $user_information["screen_name"];
			$this->nombre = $user_information["name"];
			$this->locacion = $user_information["location"];
			$this->fechaRegistro = $user_information["created_at"];
			$this->seguidores = $user_information["followers_count"];
			$this->url = "https://www.twitter.com/".$user_information["screen_name"];
		}
		public function getProfilePic(){
			return $this->profilePic;
		}
		public function getUsername()
		{
			return $this->username;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getLocacion()
		{
			return $this->locacion;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}
		public function getSeguidores()
		{
			return $this->seguidores;
		}
		public function getUrl(){
			return $this->url;
		}
	};



?>