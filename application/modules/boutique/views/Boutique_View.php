<?php include VIEWPATH.'template/includes/header.php';?>
<!-- Sidebar -->
<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>
<!-- End Sidebar -->

<div class="main-panel">
 <div class="container">




    <div class="panel-header bg-primary-gradient">
       <div class="page-inner py-3">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
             <div>
              <h2 class="text-white pb-2 fw-bold">
                Boutique
            </h2>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
         <!-- PAGE-HEADER -->
         <div class="page-header">
            <ol class="breadcrumb">
               <li class="breadcrumb-item">
                  <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="#">Boutique</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Liste des produits
            </li>
        </ol>
    </div>
    <!-- PAGE-HEADER END -->
</div>
</div>
</div>
</div>

<div class="page-inner mt--5">
        <!-- ----------------- -->
<!--         <h4 class="page-title mt-5 text-center">Listes des services disponible<hr></h4>
          <div class="row justify-content-center align-items-center">
            <div class="col-md-3 pl-md-0">
              <div class="card-pricing2 card-success">
                <div class="pricing-header">
                  <h3 class="fw-bold">Lumicash</h3>
                  <span class="sub-title">Pour Lumitel</span>
                </div>
                <div class="price-value">
                  <div class="value">
                    <span class="currency">$</span>
                    <span class="amount">10.<span>99</span></span>
                    <span class="month">/month</span>
                  </div>
                </div>
                <ul class="pricing-content">
                  <li>Transfert</li>
                  <li>Retrait</li>
                  <li>Paiement des factures</li>
                  <li class="disable">Paiement du marchand</li>
                  <li class="disable">Services bancaire</li>
                </ul>
                <a href="#" class="btn btn-success btn-border btn-lg w-75 fw-bold mb-3">Abonnez-vous</a>
              </div>
            </div>
            <div class="col-md-3 pl-md-0 pr-md-0">
              <div class="card-pricing2 card-primary">
                <div class="pricing-header">
                  <h3 class="fw-bold">Business</h3>
                </div>
                <div class="price-value">
                  <div class="value">
                    <span class="currency">$</span>
                    <span class="amount">20.<span>99</span></span>
                    <span class="month">/month</span>
                  </div>
                </div>
                <ul class="pricing-content">
                  <li>Vente des produits</li>
                  <li>Commande des produits</li>
                  <li>Facturations</li>
                  <li>Dettes</li>
                  <li class="disable">Autres services</li>
                </ul>
                <a href="#" class="btn btn-primary btn-border btn-lg w-75 fw-bold mb-3">Abonnez-vous</a>
              </div>
            </div>
            <div class="col-md-3 pr-md-0">
              <div class="card-pricing2 card-secondary">
                <div class="pricing-header">
                  <h3 class="fw-bold">Ecocash</h3>
                  <span class="sub-title">Pour EconetLeo</span>
                </div>
                <div class="price-value">
                  <div class="value">
                    <span class="currency">$</span>
                    <span class="amount">30.<span>99</span></span>
                    <span class="month">/month</span>
                  </div>
                </div>
                <ul class="pricing-content">
                  <li>Transfert</li>
                  <li>Retrait</li>
                  <li>Paiement des factures</li>
                  <li>Services divers</li>
                  <li>Club d'epargne</li>
                </ul>
                <a href="#" class="btn btn-secondary btn-border btn-lg w-75 fw-bold mb-3">Abonnez-vous</a>
              </div>
            </div>
          </div> -->
        <!-- ------------------------- -->



  <div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
        	<div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1">
                	<img class="img-fluid img-responsive rounded product-image" src="<?= base_url()?>assets/photo/boutique/cafe.jpg">
                </div>
                <div class="col-md-6 mt-1">
                    <h5>Umoja Café</h5>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2">
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        </div>
                        <span>370</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>100% naturel</span>
                    	<span class="dot"></span>
                    	<span>Riche en anti-oxydants</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>Protège le foie</span>
                    </div>
                    <p class="text-justify text-truncate para mb-0">
                    	Connu depuis des siècles pour ses qualités gustatives et stimulantes, le café souffre parfois d’idées reçues<br><br>
                    </p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$75</h4>
                        <span class="strike-text">$100</span>
                    </div>
                    <h6 class="text-success">Livraison gratuite</h6>
                    <div class="d-flex flex-column mt-4">
                    	<button class="btn btn-primary btn-sm" type="button">Détail</button>
                    	<button class="btn btn-outline-primary btn-sm mt-2" type="button">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            <div class="row p-2 mt-2 bg-white border rounded">
                <div class="col-md-3 mt-1">
                	<img class="img-fluid img-responsive rounded product-image" src="<?= base_url()?>assets/photo/boutique/fridge.jpg">
                </div>
                <div class="col-md-6 mt-1">
                    <h5>Umoja Fridge</h5>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2">
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        </div>
                        <span>50</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>Appareil simple à utiliser</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>consommez plus d'aliments frais</span>
                    </div>
                    <p class="text-justify text-truncate para mb-0">
                    	Si vous placez vos courses directement au frigo sans vous soucier de leur emballage, il y a de fortes chances qu'au bout de quelques jours, les aliments....<br><br>
                    </p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$150.00</h4>
                        <span class="strike-text">$175.00</span>
                    </div>
                    <h6 class="text-success">Livraison gratuite</h6>
                    <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Detaile</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Ajouter au panier</button></div>
                </div>
            </div>
            <div class="row p-2 mt-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="<?= base_url()?>assets/photo/boutique/the.jpg"></div>
                <div class="col-md-6 mt-1">
                    <h5>Umoja Thé</h5>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2">
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        </div>
                        <span>351</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>100% naturel</span>
                    	<span class="dot"></span>
                    	<span>stimule sans exciter</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>Diminuez le risque de diabète</span>
                    </div>
                    <p class="text-justify text-truncate para mb-0">
                    	Grâce à richesse en antioxydants, le thé est une aide précieuse pour contribuer à renforcer naturellement ses défenses immunitaires.<br><br>
                    </p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$13.99</h4>
                        <span class="strike-text">$20.99</span>
                    </div>
                    <h6 class="text-success">Livraison gratuite</h6>
                    <div class="d-flex flex-column mt-4">
                    	<button class="btn btn-primary btn-sm" type="button">Détail</button>
                    	<button class="btn btn-outline-primary btn-sm mt-2" type="button">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            <div class="row p-2 mt-1 bg-white border rounded">
                <div class="col-md-3 mt-1">
                	<img class="img-fluid img-responsive rounded product-image" src="<?= base_url()?>assets/photo/boutique/cafe1.jpg">
                </div>
                <div class="col-md-6 mt-1">
                    <h5>Burundi café</h5>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2">
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        </div><span>300</span>
                    </div>
                    <div class="mt-2 mb-1 spec-1">
                    	<span>100% naturel</span>
                    	<span class="dot"></span>
                    	<span>Disponible à Buja</span>
                    </div>
                    <p class="text-justify text-truncate para mb-0">
                    	Connu depuis des siècles pour ses qualités gustatives et stimulantes, le café souffre parfois d’idées reçues.<br><br>
                    </p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$13.00</h4><span class="strike-text">$20.99</span>
                    </div>
                    <h6 class="text-success">Livraison gratuite</h6>
                    <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Détail</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Ajouter au panier</button></div>
                </div>
            </div>


            <div class="row p-2 mt-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="<?= base_url()?>assets/photo/boutique/QpjAiHq.jpg"></div>
                <div class="col-md-6 mt-1">
                    <h5>Quant olap shirts</h5>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2">
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        </div>
                        <span>310</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>100% cotton</span>
                    	<span class="dot"></span>
                    	<span>Light weight</span>
                    	<span class="dot"></span>
                    	<span>Best finish<br></span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>Unique design</span>
                    	<span class="dot"></span>
                    	<span>For men</span>
                    	<span class="dot"></span>
                    	<span>Casual<br></span>
                    </div>
                    <p class="text-justify text-truncate para mb-0">
                    	There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.<br><br>
                    </p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$13.99</h4><span class="strike-text">$20.99</span>
                    </div>
                    <h6 class="text-success">Livraison gratuite</h6>
                    <div class="d-flex flex-column mt-4">
                    	<button class="btn btn-primary btn-sm" type="button">Détail</button>
                    	<button class="btn btn-outline-primary btn-sm mt-2" type="button">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            <div class="row p-2 bg-white border rounded mt-2">
                <div class="col-md-3 mt-1">
                	<img class="img-fluid img-responsive rounded product-image" src="<?= base_url()?>assets/photo/boutique/JvPeqEF.jpg">
                </div>
                <div class="col-md-6 mt-1">
                    <h5>Quant trident shirts & Shoes</h5>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2">
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        	<i class="fa fa-star"></i>
                        </div>
                        <span>10</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>100% cotton</span>
                    	<span class="dot"></span>
                    	<span>Poids léger</span>
                    	<span class="dot"></span>
                    	<span>Meilleure finition<br></span>
                    </div>
                    <div class="mt-1 mb-1 spec-1">
                    	<span>Design unique</span>
                    	<span class="dot"></span>
                    	<span>Pour les hommes</span>
                    	<span class="dot"></span>
                    	<span>Décontracté<br></span>
                    </div>
                    <p class="text-justify text-truncate para mb-0">Il existe de nombreuses variantes de passages de Lorem Ipsum disponibles, mais la majorité ont subi une altération sous une forme ou une autre, par l'humour injecté ou des mots aléatoires qui ne semblent même pas légèrement crédibles.<br><br>
                    </p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">$14.99</h4>
                        <span class="strike-text">$20.99</span>
                    </div>
                    <h6 class="text-success">Livraison gratuite</h6>
                    <div class="d-flex flex-column mt-4">
                    	<button class="btn btn-primary btn-sm" type="button">Détail</button>
                    	<button class="btn btn-outline-primary btn-sm mt-2" type="button">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</div>







<!-- Footer -->	
<?php include VIEWPATH.'template/includes/footer.php';?>
<!-- End Footer -->	


