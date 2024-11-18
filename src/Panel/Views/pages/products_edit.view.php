<?php   
    $product = Data::get_product_by_slug($_GET['slug']);
    $categories = Data::get_categories();

?>




      <section class="w-full h-full p-20">
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold">
                    Ürün Detay
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
                            <a href="#" class="block transition hover:text-gray-700"> Projeler </a>
                          </li>

                          <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor" >
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                          </li>
                      
                          <li>
                            <a href="#" class="block transition hover:text-gray-700"><?= $product['title'] ?></a>
                          </li>

                        </ol>
                      </nav>
                </div>
            </div>
            <form action="products_edit.php?slug=<?= $product['slug'] ?>" method="post" enctype="multipart/form-data" x-data="{
                formData: {
                    productName: '<?= $product['title'] ?>',
                    productSlug: '<?= $product['slug'] ?>',
                    productDesc: `<?= htmlspecialchars($product['description']) ?>`, // Değişiklik: Backtick kullanımı ve htmlspecialchars eklendi
                    productImage: '<?= $product['cover_image'] ?>',
                    category: '<?= $product['category_id'] ?>',
                    status: '<?= $product['status'] ?>',

                },
                isFormEmpty() {
                    return !this.formData.productName || 
                           !this.formData.productDesc;  // Sadece gerekli alanları kontrol et
                }
             }" x-init="
                tinymce.init({
                    selector: '#productDesc',
                    setup: function(editor) {
                        editor.on('change', function(e) {
                            formData.productDesc = editor.getContent();
                        });
                    },
                    // ... diğer TinyMCE ayarları ...
                });
             ">
                <div class="flex gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="status" class="text-sm font-medium text-gray-500">Ürün Durumu</label>
                        <select name="status" id="status" class="w-full rounded border border-gray-300 p-2 text-sm shadow">
                            <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Pasif</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="category" class="text-sm font-medium text-gray-500">Ürün Kategorisi</label>
                        <select name="category" id="category" class="w-full rounded border border-gray-300 p-2 text-sm shadow">
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!--About Content -->
                <div x-data="{aboutOpen: true }" x-cloak class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div @click="aboutOpen = !aboutOpen" class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                            <?= $product['title'] ?>
                        </h1>
                        <span class="shrink-0 transition duration-300" :class="{ '-rotate-180': aboutOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div x-show="aboutOpen" x-transition:enter="transition ease-out duration-100"x-transition:enter-start="opacity-0"x-transition:enter-end="opacity-100"x-transition:leave="transition ease-in duration-100"x-transition:leave-start="opacity-100"x-transition:leave-end="opacity-0">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mt-4 flex flex-col gap-2">
                                <label for="productName" class="text-sm font-medium text-gray-500">Ürün Adı</label>
                                <input type="text" 
                                       id="productName" 
                                       name="productName" 
                                       x-model="formData.productName" 
                                       @input="formData.productSlug = formData.productName
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
                                       placeholder="Ürün Adı" />
                            </div>
                            <div class="mt-4 flex flex-col gap-2">
                                <label for="productSlug" class="text-sm font-medium text-gray-500">Ürün Slug</label>
                                <input type="text" 
                                       id="productSlug" 
                                       name="productSlug"
                                       x-model="formData.productSlug" 
                                       class="w-full rounded border border-gray-300 p-2 text-sm shadow bg-gray-100" 
                                       placeholder="Ürün Slug" 
                                       readonly />
                            </div>  
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="productDesc" class="text-sm font-medium text-gray-500">Ürün Açıklama</label>
                            <textarea id="productDesc" name="productDesc" x-model="formData.productDesc"><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>
                        <div class="mt-4 flex flex-col gap-2" x-data="{ creativeCoverImagePreview: null, showUpload: <?= empty($product['cover_image']) ? 'true' : 'false' ?> }" x-cloak>
                            <label for="creativeCoverImage" class="text-sm font-medium text-gray-500">Ürün Banner Resim</label>
                            <div class="relative flex items-center justify-center w-full">
                                <!-- Mevcut resim gösterimi -->
                                <?php if (!empty($product['cover_image'])): ?>
                                <div x-show="!showUpload" class="relative w-full h-64">
                                    <img src="src/panel/Controllers/uploads/<?= htmlspecialchars($product['cover_image']) ?>" class="max-h-64 rounded-lg w-full h-full object-cover" alt="Banner">
                                    <button type="button" @click="showUpload = true" class="absolute top-0 right-4 bg-red-500 text-white rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <?php endif; ?>

                                <label x-show="showUpload" for="creativeCoverImage" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
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
                <!--Product Image Content--> 
                <div x-data="{
                    productImageOpen: true,
                    productImages: [],
                    handleImageUpload(event, index) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.productImages[index].preview = e.target.result;
                                this.productImages[index].file = file;
                            };
                            reader.readAsDataURL(file);
                        }
                    },
                    addNewImage() {
                        this.productImages.push({ preview: null, file: null });
                    },
                    removeImage(index) {
                        this.productImages.splice(index, 1);
                    }
                }" x-cloak class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div @click="productImageOpen = !productImageOpen" class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                            Ürün Resim Alanı
                        </h1>
                        <span class="shrink-0 transition duration-300" :class="{ '-rotate-180': productImageOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div x-show="productImageOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <div class="flex flex-col gap-4">
                            <div class="mt-4 flex flex-col gap-2">
                                <label class="text-sm font-medium text-gray-500">Ürün Resimleri</label>
                                
                                <!-- Mevcut resimlerin gösterimi -->
                                <div class="grid grid-cols-3 gap-4 mb-4">
                                    <?php foreach ($product['images'] as $image): ?>
                                    <div class="relative">
                                        <img src="src/panel/Controllers/uploads/<?= htmlspecialchars($image) ?>" class="w-full h-32 object-cover rounded-lg" alt="Product Image">
                                        <input type="hidden" name="existingImages[]" value="<?= htmlspecialchars($image) ?>">
                                        <button type="button" @click="$el.closest('.relative').remove()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Yeni resim yükleme alanları -->
                                <template x-for="(image, index) in productImages" :key="index">
                                    <div class="relative">
                                        <label :for="'productImage'+index" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <template x-if="!image.preview">
                                                <div class="flex flex-col items-center justify-center p-4">
                                                    <p class="text-sm text-gray-500">Resim yüklemek için tıklayın</p>
                                                </div>
                                            </template>
                                            <template x-if="image.preview">
                                                <img :src="image.preview" class="w-full h-full object-cover rounded-lg" />
                                            </template>
                                            <input type="file" 
                                                   :id="'productImage'+index" 
                                                   name="newProductImages[]" 
                                                   class="hidden" 
                                                   accept="image/*" 
                                                   @change="handleImageUpload($event, index)" />
                                        </label>
                                        <button type="button" 
                                                @click="removeImage(index)" 
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <button type="button" 
                                    @click="addNewImage()" 
                                    class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg mt-4">
                                Yeni Resim Ekle
                            </button>
                        </div>
                    </div>
                </div>
                <!--About Banner Content-->
                
                

                    <!--Seo Content -->
                <div x-data="{seoOpen: false }" x-cloak class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div @click="seoOpen = !seoOpen" class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                        Seo
                        </h1>
                        <span class="shrink-0 transition duration-300" :class="{ '-rotate-180': seoOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div x-show="seoOpen" x-transition:enter="transition ease-out duration-100"x-transition:enter-start="opacity-0"x-transition:enter-end="opacity-100"x-transition:leave="transition ease-in duration-100"x-transition:leave-start="opacity-100"x-transition:leave-end="opacity-0">
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="seoTitle" class="text-sm font-medium text-gray-500">Seo Title</label>
                            <input type="text" id="seoTitle" x-model="formData.seoTitle" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Seo Title" value="" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="seoKeywords" class="text-sm font-medium text-gray-500">Seo Keywords</label>
                            <input type="text" id="seoKeywords" x-model="formData.seoKeywords" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Seo Keywords" value="" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="wysiwyg" class="text-sm font-medium text-gray-500">Seo Açıklama</label>
                            <textarea id="wysiwyg" x-model="formData.seoDescription"><?= $product['seo_description'] ?></textarea>
                        </div>
                        
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="ogTitle" class="text-sm font-medium text-gray-500">Og Title</label>
                            <input type="text" id="ogTitle" x-model="formData.ogTitle" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Og Title" value="" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="ogDescription" class="text-sm font-medium text-gray-500">Og Description</label>
                            <input type="text" id="ogDescription" x-model="formData.ogDescription" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Og Description" value="" />
                        </div>
                        
                        <div class="mt-4 flex flex-col gap-2" x-data="{ imagePreview: null }" x-cloak>
                            <label for="ogImage" class="text-sm font-medium text-gray-500">Og Image</label>
                            <div class="relative flex items-center justify-center w-full">
                                <label for="ogImage" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" x-show="!imagePreview">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Resim yüklemek için tıklayın</span> veya sürükleyip bırakın</p>
                                        <p class="text-xs text-gray-500">PNG, JPG veya GIF (MAX. 800x400px)</p>
                                    </div>
                                    <div x-show="imagePreview" class="absolute inset-0 flex items-center justify-center">
                                        <img :src="imagePreview" class="max-h-full rounded-lg w-full h-full object-cover p-4" alt="Preview">
                                    </div>
                                    <input x-ref="fileInput" @change="const file = $refs.fileInput.files[0]; const reader = new FileReader(); reader.onload = (e) => { imagePreview = e.target.result; formData.ogImage = file.name; }; reader.readAsDataURL(file)" id="ogImage" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Seo Content -->

                <div class="mt-4 flex justify-end gap-4">
                    <a href="../site/<?= $product['slug'] ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                        Site Görünümü
                    </a>
                    <button type="submit" 
                        class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg disabled:bg-gray-400 disabled:hover:bg-gray-400 disabled:cursor-not-allowed">
                        Kaydet
                    </button>
                </div>
            </form>


        </section>



