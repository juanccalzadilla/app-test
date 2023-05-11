<?php

require_once "./inc/sidebarOptions.php";
?>
<!-- Sidenav -->
<nav id="sidenav-1" class="sidenav" data-mdb-hidden="false" data-mdb-accordion="true">
  <a class="ripple d-flex justify-content-center py-4" href="/index_persona.php" data-mdb-ripple-color="primary">
    <img id="itramiteLogo" src="../img/itramitemail.png" alt="itramiteLogo" draggable="false" class="img-fluid ripple" width="150" />
  </a>

  <ul class="sidenav-menu">
    <?php foreach ($sidebarOptions as $option) : ?>
      <?php if ($option['type'] == 'link' && $option['showItem'] == true) : ?>
        <?php $active = basename($_SERVER['PHP_SELF']) == $option['link'] ? 'active text-primary' : ''; ?>
        <li class="sidenav-item">
          <a class="sidenav-link <?=$active?>" href="<?= $option['link']?>">
            <i class="<?= $option['icon'] ?> fa-fw me-3 <?=$active?>"></i><span><?= $option['name'] ?></span></a>
        </li>
      <?php elseif ($option['type'] == 'dropdown' && $option['showItem'] == true) : ?>
        <li class="sidenav-item">
          <?php $active = in_array(basename($_SERVER['PHP_SELF']), $option['links']) ? 'active text-primary' : ''; ?>
          <a class="sidenav-link"><i class="<?= $option['icon'] ?> fa-fw me-3 <?=$active?>"></i><span><?= $option['name'] ?></span></a>
          <ul class="sidenav-collapse">
            <?php foreach ($option['dropdown'] as $dropdownItem) : ?>
              <?php if($dropdownItem['showItem'] == true):?>
              <li class="sidenav-item">
                <a class="sidenav-link" href="<?= $dropdownItem['link'] ?>"><?= $dropdownItem['name'] ?></a>
              </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</nav>
<!-- Sidenav -->

<!-- Navbar -->

<style>
  @media (min-width: 1400px) {

    main,
    header,
    #main-navbar {
      padding-left: 240px;
    }
  }
</style>
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-1">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggler -->
    <button data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1" class="btn shadow-0 p-0 me-3 d-block d-xxl-none" aria-controls="#sidenav-1" aria-haspopup="true">
      <i class="fas fa-bars fa-lg"></i>
    </button>

    <!-- Search form -->
    <form class="d-none d-md-flex input-group w-auto my-auto">
      <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
      <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
    </form>

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">
      <!-- Notification dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">Some news</a></li>
          <li><a class="dropdown-item" href="#">Another news</a></li>
          <li>
            <a class="dropdown-item" href="#">Something else here</a>
          </li>
        </ul>
      </li>

      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0" href="#">
          <i class="fas fa-fill-drip"></i>
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="#">
          <i class="fab fa-github"></i>
        </a>
      </li>

      <!-- Icon dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="flag-united-kingdom flag m-0"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="#"><i class="flag-united-kingdom flag"></i>English
              <i class="fa fa-check text-success ms-2"></i></a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="flag-portugal flag"></i>Português</a>
          </li>
        </ul>
      </li>

      <!-- Avatar -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle" height="22" alt="Avatar" loading="lazy" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">My profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->