

        <!--Dashboard-->
        <section class="w-full h-full p-20">
            <!-- Header -->
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold">
                    Kategori Ekle
                </h1>
                <div>
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center gap-1 text-sm text-gray-600">
                          <li>
                            <a href="#" class="block transition hover:text-gray-700">
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
                            <a href="#" class="block transition hover:text-gray-700"> Kategoriler </a>
                          </li>

                          <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor" >
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                          </li>
                      
                          <li>
                            <a href="#" class="block transition hover:text-gray-700"> Kategori Ekle </a>
                          </li>

                        </ol>
                      </nav>
                </div>
            </div>
            <form action="categories_creative.php" method="post" enctype="multipart/form-data" x-data="{
                formData: {
                    categoryName: '',
                    categorySlug: '',
                    categoryCreativeDesc: '',
                    status: '1'
                },
                isFormEmpty() {
                    return !this.formData.categoryName || 
                           !this.formData.categorySlug || 
                           !this.formData.categoryCreativeDesc;
                }
             }" x-init="
                $watch('formData.categoryName', (value) => {
                    formData.categorySlug = value.toLowerCase()
                        .replace(/[^a-z0-9]/g, '-')
                        .replace(/-+/g, '-')
                        .replace(/^-|-$/g, '');
                })
             ">
                 <div class="inline-flex justify-end items-start flex-col mt-4">
                    <label for="status" class="text-sm font-medium text-gray-500">Durum</label>
                    <select id="status" name="status" x-model="formData.status" class="w-full rounded border border-gray-300 p-2 text-sm shadow">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </select>
                </div>

                <!--About Content -->
                <div x-data="{creativeOpen: true }" x-cloak class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div @click="creativeOpen = !creativeOpen" class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                            Kategori Adı
                        </h1>
                        <span class="shrink-0 transition duration-300" :class="{ '-rotate-180': creativeOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div x-show="creativeOpen" x-transition:enter="transition ease-out duration-100"x-transition:enter-start="opacity-0"x-transition:enter-end="opacity-100"x-transition:leave="transition ease-in duration-100"x-transition:leave-start="opacity-100"x-transition:leave-end="opacity-0">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mt-4 flex flex-col gap-2">
                                <label for="categoryName" class="text-sm font-medium text-gray-500">Kategori Adı</label>
                                <input type="text" 
                                       id="categoryName" 
                                       name="categoryName" 
                                       x-model="formData.categoryName" 
                                       @input="formData.categorySlug = formData.categoryName
                                        .toLowerCase()
                                        .replace(/ğ/g, 'g')
                                        .replace(/ü/g, 'u')
                                        .replace(/ş/g, 's')
                                        .replace(/ı/g, 'i')
                                        .replace(/İ/g, 'i')
                                        .replace(/ö/g, 'o')
                                        .replace(/ç/g, 'c')
                                        .replace(/[^a-z0-9\s-]/g, '')
                                        .replace(/\s+/g, '-')
                                        .replace(/-+/g, '-')
                                        .trim()"
                                       class="w-full rounded border border-gray-300 p-2 text-sm shadow" 
                                       placeholder="Kategori Adı" />
                            </div>
                            <div class="mt-4 flex flex-col gap-2">
                                <label for="categorySlug" class="text-sm font-medium text-gray-500">Kategori Slug</label>
                                <input type="text" 
                                       id="categorySlug" 
                                       name="categorySlug"
                                       x-model="formData.categorySlug" 
                                       class="w-full rounded border border-gray-300 p-2 text-sm shadow bg-gray-100" 
                                       placeholder="Kategori Slug" 
                                       readonly />
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="categoryCreativeDesc" class="text-sm font-medium text-gray-500">Kategori Açıklama</label>
                            <textarea id="categoryCreativeDesc" name="categoryCreativeDesc" x-model="formData.categoryCreativeDesc"></textarea>
                        </div>
                        <div class="mt-4 flex flex-col gap-2" x-data="{ creativeCoverImagePreview: null, showUpload: <?= empty($creative['cover_image']) ? 'true' : 'false' ?> }" x-cloak>
                            <label for="creativeCoverImage" class="text-sm font-medium text-gray-500">Kategori Kapak Resim</label>
                            <div class="relative flex items-center justify-center w-full">
                                <!-- Mevcut resim gösterimi -->
                                <?php if (!empty($category['cover_image'])): ?>
                                <div x-show="!showUpload" class="relative w-full h-64">
                                    <img src="uploads/<?= htmlspecialchars($category['cover_image']) ?>" class="max-h-64 rounded-lg w-full h-full object-cover" alt="Banner">
                                    <button type="button" @click="showUpload = true" class="absolute top-0 right-4 bg-red-500 text-white rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <?php endif; ?>

                                <!-- Yükleme alanı -->
                                <label x-show="showUpload" for="creativeCoverImage" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <!-- Mevcut yükleme alanı içeriği -->
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" x-show="!creativeCoverImagePreview">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Resim yüklemek için tıklayın</span> veya sürükleyip bırakın</p>
                                        <p class="text-xs text-gray-500">PNG, JPG veya GIF (MAX. 800x400px)</p>
                                    </div>
                                    <div x-show="creativeCoverImagePreview" class="absolute inset-0 flex items-center justify-center">
                                        <img :src="creativeCoverImagePreview" class="max-h-full rounded-lg w-full h-full object-cover p-4" alt="Preview">
                                    </div>
                                    <input x-ref="creativeCoverImageFileInput" @change="const file = $refs.creativeCoverImageFileInput.files[0]; const reader = new FileReader(); reader.onload = (e) => { creativeCoverImagePreview = e.target.result; }; reader.readAsDataURL(file)" id="creativeCoverImage" name="creativeCoverImage" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <!--About Content -->
                
                <div class="mt-4 flex justify-end">
                    <button type="submit" 
                        class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg disabled:bg-gray-400 disabled:hover:bg-gray-400 disabled:cursor-not-allowed">
                        Kaydet
                    </button>
                </div>
            </form>


        </section>
    </main>
