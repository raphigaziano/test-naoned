<!DOCTYPE HTML>
<html>
    <head>
        <meta charset='utf-8'/>
        <title>Test Naoned - Annuaire Musées</title>
        <link rel='stylesheet' type='text/css'
              href='<?php get_static_url('bootstrap/css/bootstrap.min.css'); ?>' />
        <link rel='stylesheet' type='text/css'
              href='<?php get_static_url('bootstrap/css/bootstrap-responsive.min.css'); ?>' />
 	    <link rel='stylesheet' type='text/css'
	          href='<?php get_static_url('css/base.css'); ?>' />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>

    <body>
    <!-- header -->
    <header>
      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">Annuaire Musées</a>
            <div class="nav-collapse collapse">
	      <!-- Menu -->
	      <nav>
                <ul id='topnav' class="nav">
                  <li><a href="/">Acceuil</a></li>
                  <li><a href="?action=edit&amp;which=fiches">Ajouter une fiche</a></li>
                  <li><a href="?action=edit&amp;which=categories">Editer les catégories</a></li>
                </ul>
          </nav>
	      <!--/ Menu -->
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>
    </header>
    <!--/ header -->
<div class="container-fluid">
  <div class="row-fluid">
    <?php categories_menu();?>
      <div class="span8 offset1">
