<?php 
    $page = basename($_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $view_bag['title'] ?? 'Admin Panel' ?></title>
    <link rel="stylesheet" href="<?= panel_assets('css/style.css') ?>">
    <link rel="stylesheet" href="<?= panel_assets('css/output.css') ?>">
    
</head>
<body>
  <?php if($page != 'login.php' && $page != 'register.php') : ?>
<main class="w-full h-full flex bg-gradient-to-l to-amber-50 from-white">
        <section class=" h-full sticky top-0">
                    
            <div class="flex h-screen w-52 flex-col justify-between border-e bg-white">
                <div>
                    <div class="inline-flex p-4 gap-4 items-center justify-center">
                        <span class="grid size-10 place-content-center rounded-lg bg-gray-100 text-xs text-gray-600">
                        EI
                        </span>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-400">
                                Admin
                            </span>
                            <span class="text-sm font-medium">
                                Enes İnan
                            </span>
                            
                        </div>
                    </div>
                    <?php 
                    $page = basename($_SERVER['PHP_SELF']);
                    ?>

                    <div class="border-t border-gray-100">
                        <ul class="mt-6 space-y-1">
                            <li>
                                <a href="index.php" class="block rounded-lg px-4 py-2 text-sm <?php echo ($page == 'index.php') ? 'bg-gray-100 text-gray-700 font-bold'  : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' ?>">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="about.php" class="block rounded-lg px-4 py-2 text-sm <?php echo ($page == 'about.php') ? 'bg-gray-100 text-gray-700 font-bold'  : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' ?>">
                                    Hakkımızda
                                </a>
                            </li>
                            <li>
                                <a href="products.php" class="block rounded-lg px-4 py-2 text-sm <?php echo ($page == 'products.php') ? 'bg-gray-100 text-gray-700 font-bold'  : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' ?>">
                                    Ürünler
                                </a>
                            </li>
                            <li>
                                <a href="contact.php" class="block rounded-lg px-4 py-2 text-sm <?php echo ($page == 'contact.php') ? 'bg-gray-100 text-gray-700 font-bold'  : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' ?>">
                                    İletişim
                                </a>
                            </li>
                            <li>
                                <a href="users.php" class="block rounded-lg px-4 py-2 text-sm  <?php echo ($page == 'users.php') ? 'bg-gray-100 text-gray-700 font-bold'  : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' ?>">
                                    Kullanıcılar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            
                <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 bg-white p-2 border-r">
                    <a href="exit.php" class="group relative flex w-full justify-center rounded-lg  px-2 py-1.5 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
            
                    <span class="invisible absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white group-hover:visible" >
                        Logout
                    </span>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>
