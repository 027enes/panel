
<?php
    $items = Data::get_products();
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $itemsPerPage = 10;
    $totalItems = count($items);
    $totalPages = ceil($totalItems / $itemsPerPage);
    if($currentPage < 1) $currentPage = 1;
    if($currentPage > $totalPages) $currentPage = $totalPages;
    $offset = ($currentPage - 1) * $itemsPerPage;
    $items = array_slice($items, $offset, $itemsPerPage);
     $categories = Data::get_categories();
     if(isset($_GET['search'])){
         $items = Data::get_products_by_search($_GET['search']);
     }

     

?>

        <!--Dashboard-->
        <section class="w-full h-full p-20 relative" x-data="{deleteSlug: '', deleteTitle: ''}" x-cloak>
            <!-- Header -->
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold">
                    Projeler
                </h1>
                <div>
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center gap-1 text-sm text-gray-600">
                          <li>
                            <a href="dashboard.html" class="block transition hover:text-gray-700">
                              <span class="sr-only"> Dashboard </span>
                      
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                              </svg>
                            </a>
                          </li>
                      
                          <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor" >
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                          </li>
                      
                          <li>
                            <a href="#" class="block transition hover:text-gray-700"> Projeler </a>
                          </li>

                        </ol>
                      </nav>
                </div>
            </div>
   
                <!-- Content -->
                <div class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                            Projeler
                        </h1>
                    </div>
                    

                    <div class="relative overflow-x-auto  sm:rounded-lg">
                        <form id="searchForm" class="bg-white flex justify-between">
                            <div class="relative py-4">
                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       class="block py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-amber-500 focus:border-amber-500" 
                                       placeholder="Search for items"
                                       >
                            </div>
                            <div class="flex gap-2">
                                <a href="products_creative.php" class="h-10 font-medium flex items-center justify-center text-white bg-amber-500 hover:bg-amber-600 px-2 py-1 rounded-lg ">Yeni Ürün</a>
                                <a href="categories.php" class="h-10 font-medium flex items-center justify-center text-white bg-amber-500 hover:bg-amber-600 px-2 py-1 rounded-lg ">Kategori</a>
                            </div>
                        </form>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-2xl bg-white">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="p-4">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Proje Resmi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Proje Adı
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Proje Slug
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Durum
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        İşlemler
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php foreach($items as $item): ?>
                                    
                                    <tr class="bg-white border-b hover:bg-gray-50 last:border-b-0">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500    focus:ring-2  ">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if(!empty($item['cover_image'])): ?>
                                                <img src="src/panel/controllers/uploads/<?= htmlspecialchars($item['cover_image']) ?>" alt="Proje Resmi" class="w-14 h-14 rounded-lg object-cover">
                                            <?php else: ?>
                                                <div class="w-14 h-14 rounded-lg bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-400">No Image</span>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap ">
                                            <span>
                                                <?= $item['title']; ?>
                                            </span>
                                        </th>
                                        <td class="px-6 py-4">
                                            <span><?= $item['slug']; ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span>
                                                <?php foreach($categories as $category): ?>
                                                    <?php if($category['id'] == $item['category_id']): ?>
                                                        <?= $category['title']; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4" x-data="{status: false}" x-bind:class="{'text-green-500': <?= $item['status']; ?>, 'text-red-500': !<?= $item['status']; ?>}">
                                            <span><?= $item['status'] ? 'Aktif' : 'Pasif'; ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="products_edit.php?slug=<?= htmlspecialchars($item['slug']); ?>" class="font-bold text-white bg-amber-500 hover:bg-amber-600 px-2 py-1 rounded-lg">Düzenle</a>
                                            <button @click="deleteSlug = '<?= htmlspecialchars($item['slug']); ?>'; deleteTitle = '<?= htmlspecialchars($item['title']); ?>'" 
                                                    class="font-bold text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded-lg">Sil</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                                
                        </table>
                        
                    </div>
                     <!--pagination-->
                    <div class="flex items-center justify-between px-4 py-3 sm:px-6">
                        <div class="flex flex-1 justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                <span class="font-bold"><?= $totalItems; ?></span>
                            Ürün
                            </p>
                        </div>


                        <div>

                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <?php if($currentPage > 1): ?>
                                    <a href="?page=<?= $currentPage - 1 ?>" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Önceki</span>
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>

                                        <?php
                                        // Sayfa numaralarını göster
                                        for($i = 1; $i <= $totalPages; $i++):
                                            if($i == $currentPage):
                                        ?>
                                            <a href="?page=<?= $i ?>" aria-current="page" class="relative z-10 inline-flex items-center bg-amber-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600"><?= $i ?></a>
                                        <?php else: ?>
                                            <a href="?page=<?= $i ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"><?= $i ?></a>
                                        <?php 
                                            endif;
                                        endfor; 
                                        ?>

                                        <?php if($currentPage < $totalPages): ?>
                                            <a href="?page=<?= $currentPage + 1 ?>" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                                <span class="sr-only">Sonraki</span>
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                            </nav>
                        </div>

                    </div>
                </div>
               
                <!-- Content -->

                <!-- Delete Modal -->
                <form action="delete.php" method="post" x-show="deleteSlug != ''" x-cloak>
                    <input type="hidden" name="slug" :value="deleteSlug">
                    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="bg-white p-4 rounded-lg shadow-lg w-[600px]">
                            <div class="flex justify-between items-center w-full">
                                <h2 class="text-2xl font-bold"><span x-text="deleteTitle"></span> Projesini Sil</h2>
                                <span @click="deleteSlug = ''; deleteTitle = ''" class="cursor-pointer font-bold text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded-lg">x</span>
                            </div>
                            <div class="flex flex-col gap-4">
                                <p>Bu projeyi silmek istediğinize emin misiniz?</p>
                                <div class="flex gap-2">
                                    <button type="submit" class="font-bold text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded-lg">Sil</button>
                                    <button type="button" @click="deleteSlug = ''; deleteTitle = ''" class="font-bold text-white bg-gray-500 hover:bg-gray-600 px-2 py-1 rounded-lg">İptal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

</section>

<script>
let searchTimeout;
const tbody = document.querySelector('table tbody');

function handleSearch(value) {
    clearTimeout(searchTimeout);
    
    if (value.length >= 2) {
        searchTimeout = setTimeout(() => {
            fetch(`search_products.php?search=${encodeURIComponent(value)}`)
                .then(response => response.text())
                .then(html => {
                    tbody.innerHTML = html;
                });
        }, 500);
    } else if (value.length === 0) {
        // Arama boşsa tüm ürünleri göster
        fetch('search_products.php')
            .then(response => response.text())
            .then(html => {
                tbody.innerHTML = html;
            });
    }
}

document.getElementById('search').addEventListener('input', (e) => handleSearch(e.target.value));
</script>