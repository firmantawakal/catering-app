<nav class="sidebar">
    <div class="sidebar-header">
                    
        <a href="#" class="sidebar-brand"> <img src="<?php echo base_url().'assets/images/logo-horizontal.png' ?>" style="width: 50px;"/></a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
        <!-- MENU ADMIN -->
        <?php 
        if ($this->session->userdata('level')=='admin') { ?>
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'home' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('home') ?>" class="nav-link">
                    <i class="link-icon" data-feather="home"></i><span class="link-title">Home</span></a>
            </li>  
            <li class="nav-item nav-category">Data Master</li>

            <li class="nav-item <?php echo ($this->uri->segment(1) == 'acara' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('acara') ?>" class="nav-link">
                    <i class="link-icon" data-feather="star"></i><span class="link-title">Acara</span></a>
            </li>  
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'barang' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('barang') ?>" class="nav-link">
                    <i class="link-icon" data-feather="box"></i><span class="link-title">Barang</span></a>
            </li>  
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'customer' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('customer') ?>" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i><span class="link-title">Customer</span></a>
            </li>  
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'satuan' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('satuan') ?>" class="nav-link">
                    <i class="link-icon" data-feather="menu"></i><span class="link-title">Satuan</span></a>
            </li>  
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'fungsi' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('fungsi') ?>" class="nav-link">
                    <i class="link-icon" data-feather="menu"></i><span class="link-title">Fungsi</span></a>
            </li>  
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'user' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('user') ?>" class="nav-link">
                    <i class="link-icon" data-feather="user"></i><span class="link-title">User</span></a>
            </li>  

            <li class="nav-item nav-category">Transaksi</li>

            <li class="nav-item <?php echo ($this->uri->segment(1) == 'barang_keluar' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('barang_keluar') ?>" class="nav-link">
                    <i class="link-icon" data-feather="share"></i><span class="link-title">Barang Keluar</span></a>
            </li>  
           
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'barang_masuk' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('barang_masuk') ?>" class="nav-link">
                    <i class="link-icon" data-feather="download"></i><span class="link-title">Barang Masuk</span></a>
            </li> 
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'pinjam' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('pinjam') ?>" class="nav-link">
                    <i class="link-icon" data-feather="cpu"></i><span class="link-title">Barang Pinjam</span></a>
            </li> 
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'rusak' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('rusak') ?>" class="nav-link">
                    <i class="link-icon" data-feather="code"></i><span class="link-title">Barang Rusak</span></a>
            </li> 
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'hilang' ? 'active' : ''); ?>">
                <a href="<?php echo site_url('hilang') ?>" class="nav-link">
                    <i class="link-icon" data-feather="compass"></i><span class="link-title">Barang Hilang</span></a>
            </li> 

            <li class="nav-item nav-category">Report & Backup</li>
            <li class="nav-item">
                <a href="<?php echo site_url('report/backupdb') ?>" class="nav-link">
                    <i class="link-icon" data-feather="database"></i><span class="link-title">Backup Database</span></a>
            </li> 
        <?php
            }
        ?>
            
            
       
        </ul>
    </div>
</nav>