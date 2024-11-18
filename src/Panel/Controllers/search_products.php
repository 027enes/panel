<?php
session_start();
require dirname(__DIR__, 3) . '/config/app.php';
Data::ensure_user_is_authenticated();
$items = isset($_GET['search']) ? 
    Data::get_products_by_search($_GET['search']) : 
    Data::get_products();
$categories = Data::get_categories();
?>

<?php if(!empty($items)): ?>
<?php foreach($items as $item): ?>
    <tr class="bg-white border-b hover:bg-gray-50 last:border-b-0">
        <td class="w-4 p-4">
            <div class="flex items-center">
                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 focus:ring-2">
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
        <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
            <span><?= htmlspecialchars($item['title']) ?></span>
        </th>
        <td class="px-6 py-4">
            <span><?= htmlspecialchars($item['slug']) ?></span>
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
        <td class="px-6 py-4" x-data="{status: <?= $item['status'] ?>}" x-bind:class="{'text-green-500': status, 'text-red-500': !status}">
            <span><?= $item['status'] ? 'Aktif' : 'Pasif' ?></span>
        </td>
        <td class="px-6 py-4">
            <a href="edit.php?slug=<?= htmlspecialchars($item['slug']) ?>" class="font-bold text-white bg-amber-500 hover:bg-amber-600 px-2 py-1 rounded-lg">Düzenle</a>
            <button @click="deleteSlug = '<?= htmlspecialchars($item['slug']) ?>'; deleteTitle = '<?= htmlspecialchars($item['title']) ?>'" 
                    class="font-bold text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded-lg">Sil</button>
            </td>
        </tr>

    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="12" class="text-center text-base font-bold py-4">Aradığınız kriterlere uygun ürün bulunamadı.</td>
    </tr>
<?php endif; ?>