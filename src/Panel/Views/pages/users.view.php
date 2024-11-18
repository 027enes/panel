
<?php
    $users = Data::get_users();

?>
<div x-data="{ 
    showSuccess: <?= isset($view_bag['success']) && !empty($view_bag['success']) ? 'true' : 'false' ?>,
    showError: <?= isset($view_bag['error']) && !empty($view_bag['error']) ? 'true' : 'false' ?> 
}" 
x-init="() => {
    if(showSuccess) setTimeout(() => showSuccess = false, 5000);
    if(showError) setTimeout(() => showError = false, 5000);
}" x-cloak>
    
    <!-- Başarı Mesajı -->
    <div x-show="showSuccess"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-full"
         class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <?= htmlspecialchars($view_bag['success'] ?? '') ?>
        <button @click="showSuccess = false" class="ml-2 text-white hover:text-gray-200">
            ×
        </button>
    </div>

    <!-- Hata Mesajı -->
    <div x-show="showError"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-full"
         class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <?= htmlspecialchars($view_bag['error'] ?? '') ?>
        <button @click="showError = false" class="ml-2 text-white hover:text-gray-200">
            ×
        </button>
    </div>
</div>


<!--Dashboard-->
        <section class="w-full h-full p-20" x-data="{modalOpen: false, deleteModalOpen: false}" x-cloak>
            <!-- Header -->
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold">
                    Kullanıcılar
                </h1>
                <div>
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center gap-1 text-sm text-gray-600">
                          <li>
                            <a href="dashboard.html" class="block transition hover:text-gray-700">
                              <span class="sr-only"> Anasayfa </span>
                      
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
                            <a href="#" class="block transition hover:text-gray-700"> Kullanıcılar </a>
                          </li>

                        </ol>
                      </nav>
                </div>
            </div>
   
                <!-- Content -->
                <div class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                        Kullanıcılar
                        </h1>
                    </div>
                    

                    <div class="relative overflow-x-auto  sm:rounded-lg">
                        <div class="bg-white">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative py-4">
                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="table-search" class="block py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-amber-500 focus:border-amber-500" placeholder="Search for items">
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-2xl bg-white">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="p-4">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Şifre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        İşlemler
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                <tr class="bg-white border-b hover:bg-gray-50 last:border-b-0">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 focus:ring-2">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?= htmlspecialchars($user['email']); ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="password" value="<?= htmlspecialchars($user['password']); ?>" disabled class="w-full rounded border-none disabled:bg-transparent p-2 text-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <button @click="modalOpen = <?= $user['id']; ?>" class="font-medium text-white bg-amber-500 hover:bg-amber-600 px-2 py-1 rounded-lg">Düzenle</button>
                                        <button @click="deleteModalOpen = <?= $user['id']; ?>" class="font-medium text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded-lg">Sil</button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div x-show="modalOpen === <?= $user['id']; ?>" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                                    <div class="bg-white p-4 rounded-lg w-[600px]" x-show="modalOpen === <?= $user['id']; ?>" x-transition>
                                        <form action="users_update.php" method="post">
                                            <div class="flex justify-between">
                                                <h1 class="text-2xl font-bold">Kullanıcı Düzenle</h1>
                                            <button @click="modalOpen = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                    <path d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                </button>
                                            </div>
                                            <div x-data="{ 
                                                formData: {
                                                id: '<?= $user['id']; ?>',
                                                email: '<?= htmlspecialchars($user['email']); ?>', 
                                                password: ''
                                            }
                                            }">
                                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                            <div class="mt-4 flex flex-col gap-2">
                                                <label for="email_<?= $user['id']; ?>" class="text-sm font-medium text-gray-500">Email</label>
                                                <input type="email" 
                                                       name="email"
                                                       id="email_<?= $user['id']; ?>" 
                                                       x-model="formData.email"
                                                       class="w-full rounded border border-gray-300 p-2 text-sm shadow" 
                                                       placeholder="Email">
                                            </div>
                                            <div class="mt-4 flex flex-col gap-2">
                                                <label for="password_<?= $user['id']; ?>" class="text-sm font-medium text-gray-500">Şifre</label>
                                                <input type="password" 
                                                       name="password"
                                                       id="password_<?= $user['id']; ?>" 
                                                       x-model="formData.password"
                                                       class="w-full rounded border border-gray-300 p-2 text-sm shadow" 
                                                       placeholder="Yeni şifre">
                                            </div>
                                            <div class="grid grid-cols-2 gap-4 mt-4">
                                                <button type="submit" 
                                                        class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg">
                                                    Kaydet
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div x-show="deleteModalOpen === <?= $user['id']; ?>" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                                    <div class="bg-white p-4 rounded-lg w-[600px]" x-show="deleteModalOpen === <?= $user['id']; ?>" x-transition>
                                        <div class="flex justify-between">
                                            <h1 class="text-2xl font-bold"><?= htmlspecialchars($user['email']); ?> Kullanıcı Sil</h1>
                                            <button @click="deleteModalOpen = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                    <path d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="mt-4 flex flex-col gap-2">
                                            <p>Bu kullanıcıyı silmek istediğinizden emin misiniz?</p>
                                        </div>
                                        <form action="users_delete.php" method="post">
                                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Sil</button>
                                        </form>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Content -->
                
        </section>
    </main>

