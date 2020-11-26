<?php
class PageBase {
	private $style = array (
			'bootstrap',
			'bootstrap.min',
			'bootstrap-theme',
			'bootstrap-theme.min',
			'Normalize'
	); // mettre juste le nom du fichier SANS l'extension css
	private $script = array (
			'utile' //script gérant les affichages des messages d'erreur et aussi la redirection
	); // mettre juste le nom du fichier SANS l'extension js
	private $scriptExec = array(); //script que l'on veut executer 
	private $motsCles;
	private $description;
	private $titre;
	private $entete;
	protected $menu;
	private $contenu;
	private $zoneErreur;
	private $piedpage;
	public function __construct($t) {
		$this->titre = $t;
		$this->description = 'Liberté de se déplacer';
		$this->motsCles = 'vélo, électrique, ville, déplacement,liberté';
		$this->entete = '<div class="page-header">
       <h1><a href="index.php"><img src="./Image/logovelopetit.png" alt="logo d\'un velo"></a> VELIBERTE : la liberté de se déplacer en ville</h1>  
           </div>';
		
		$this->menu = '<div id="navbar" class="navbar sticky-top navbar-light bg-light">
				<div class="navbar-header">
      				<a class="navbar-brand" href="../VUE/verifSessionOK.php">Connexion</a>
    			</div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">VELIBERTE</a></li>
            <li><a href="consultationVelosClassiquesDispos.php">Velos classiques </a></li>
            <li><a href="consultationVelosElectriqueDispos.php">Vélos Electriques</a></li>
            <li><a href="map_carte.php">Carte Google MAP</a></li>
			</ul>
		</div>';
		$this->zoneErreur='';
		
		$this->piedpage = '<div class="page-footer"><h6>copyright 1FO SIO 49 Chevrollier : 1fo.sio.49@gmail.com - technologies mises en oeuvre PHP objet - MVC - jquery - Ajax - Bootstrap</h6></div>';
	}
	public function __set($propriete, $valeur) {
		switch ($propriete) {
			case 'motsCles' :
				{
					$this->motsCles .= $valeur;
					break;
				}
			case 'style' :
				{
					$this->style [count ( $this->style ) + 1] = $valeur;
					break;
				}
			case 'script' :
				{
					$this->script [count ( $this->script ) + 1] = $valeur;
					break;
				}
			case 'scriptExec' :
				{
					$this->scriptExec [count ( $this->scriptExec ) + 1] = $valeur;
					break;
				}
					
			case 'titre' :
				{
					$this->titre = $valeur;
					break;
				}
			case 'contenu' :
				{
					$this->contenu = $valeur;
					break;
				}
			case 'zoneErreur' :
				{
					$this->zoneErreur = $valeur;
					break;
						}
		}
	}
	public function __get($propriete) {
		switch ($propriete) {
			
			case 'contenu' :
				{
					return $this->contenu;
					break;
				}
		}
	}
	/**
	 * *************Gestion des mots clés ************************
	 */
	/* Insertion des mots clés */
	protected function charge_motsCles() {
		echo "<meta name='keywords' lang='fr' content='" . $this->motsCles . "' />";
		echo ("\n");
	}
	
	/**
	 * ************Gestion de la description *************************
	 */
	/* Insertion de la description du site */
	protected function charge_description() {
		echo "<meta name='description' content='" . $this->description . "'/>";
		echo ("\n");
	}
	/**
	 * *************Gestion des styles ***************************
	 */
	/* Insertion des feuilles de style */
	protected function charge_style() {
		foreach ( $this->style as $s ) {
			echo "<link rel='stylesheet' type='text/css' href='../VUE/Style/" . $s . ".css'/>";
			echo ("\n");
		}
	}
	
	/**
	 * ***********Gestion des scripts ***************************
	 */
	/* Insertion des script JAVASCRIPT */
	protected function charge_script() {
		foreach ( $this->script as $sc ) {
			echo "<script type='text/javascript' src='../VUE/Script/" . $sc . ".js'></script>\n";
		}
	}
	/**
	 * ******Gestion des scripts A EXECUTER *********
	 */
	/* EXECUTION des script JAVASCRIPT */
	protected function exec_script() {
		echo "<script type='text/javascript'>";
		foreach ( $this->scriptExec as $se ) {
			echo " ".$se ;
		}
		echo "</script>";
	}
	/**
	 * ******Gestion de l'entete *******************
	 */
	protected function affiche_entete() {
		echo $this->entete;
	}
	/**
	 * *******Gestion de la zone d'erreur **************
	 */
	protected function affiche_zone_erreur() {
		echo $this->zoneErreur;
	}
	/**
	 * *********Gestion du pied de page ****************
	 */
	protected function affiche_pied_page() {
		echo $this->piedpage;
	}
	/**
	 * **********Gestion du menu *********************
	 */
	protected function affiche_menu() {
		echo $this->menu;
	}
	/**
	 * *******METHODE AFFICHER *************************
	 */
	public function afficher() {
		?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<title> <?php echo $this->titre;?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<?php $this->charge_motsCles();?>
	<?php $this->charge_description();?>
	<?php $this->charge_style();?>
	<?php $this->charge_script();?>
	
</head>
<body>
<div class="container-fluid">
	<div class="container-fluid"><?php $this->affiche_entete();?></div>
	<div class="container-fluid"><?php $this->affiche_menu();?></div>
	<div class="container-fluid"><?php echo $this->contenu;?></div>
	<div class="container-fluid"><?php $this->affiche_zone_erreur();?>
		<?php $this->exec_script();?></div>
	<div class="container-fluid"><?php $this->affiche_pied_page();?></div>
</div>



</body>
</html>
<?php
	}
}
?>