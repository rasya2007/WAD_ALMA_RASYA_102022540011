<style>
    header {
        background: #1c2b4a;
        color: #C8DFDB;
        padding: 16px 24px;
        margin-bottom: 24px;
        text-align: center;
    }
    header .brand {
        font-size: 20px;
        font-weight: bold;
        margin: 0 0 10px;
    }
    header nav a {
        color: #C8DFDB;
        text-decoration: none;
        margin-right: 18px;
        font-size: 14px;
    }
    header nav a:hover {
        text-decoration: underline;
    }
    header nav a.active {
        font-weight: bold;
        text-decoration: underline;
    }
</style>

<header>
    <p class="brand">
        <a href="index.php" style="color:inherit; text-decoration:none;">Don N Done</a>
    </p>
    <nav>
        <a href="service.php"   class="<?= ($active ?? '') === 'service'   ? 'active' : '' ?>">Service &amp; Rate Module</a>
        <a href="machine2.php"  class="<?= ($active ?? '') === 'machine'   ? 'active' : '' ?>">Machinery &amp; Equipment Module</a>
        <a href="pelanggan.php" class="<?= ($active ?? '') === 'pelanggan' ? 'active' : '' ?>">Customer Data Module</a>
        <a href="cleaning.php"  class="<?= ($active ?? '') === 'cleaning'  ? 'active' : '' ?>">Cleaning Material Module</a>
    </nav>
</header>