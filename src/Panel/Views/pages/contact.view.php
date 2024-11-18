<?php   
    $contact = Data::get_contact();
    $social = Data::get_social_media();

?>


      <section class="w-full h-full p-20">
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold">
                    İletişim
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
                            <a href="#" class="block transition hover:text-gray-700"> İletişim </a>
                          </li>

                        </ol>
                      </nav>
                </div>
            </div>
            <form action="contact.php" method="post" enctype="multipart/form-data" x-data="{
                formData: {
                    contactPhone: '<?= $contact['phone_number'] ?>',
                    contactEmail: '<?= $contact['email'] ?>',
                    contactLocation: '<?= $contact['location'] ?>',
                    contactBannerImage: '<?= $contact['banner_image'] ?>',
                    socialMedias: [
                        <?php 
                        if (!empty($contact['social_media']) && is_array($contact['social_media'])):
                            foreach ($contact['social_media'] as $social): 
                        ?>
                            { name: '<?= $social['name'] ?>', url: '<?= $social['url'] ?>' },
                        <?php 
                            endforeach; 
                        endif;
                        ?>
                    ]
                },
                isFormEmpty() {
                    return !this.formData.contactPhone || 
                           !this.formData.contactEmail || 
                           !this.formData.contactLocation ||
                           !this.formData.contactBannerImage;
                }
             }">

                <!--About Content -->
                <div x-data="{contactOpen: true }" x-cloak class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div @click="contactOpen = !contactOpen" class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                            İletişim
                        </h1>
                        <span class="shrink-0 transition duration-300" :class="{ '-rotate-180': contactOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div x-show="contactOpen" x-transition:enter="transition ease-out duration-100"x-transition:enter-start="opacity-0"x-transition:enter-end="opacity-100"x-transition:leave="transition ease-in duration-100"x-transition:leave-start="opacity-100"x-transition:leave-end="opacity-0">
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="contactPhone" class="text-sm font-medium text-gray-500">Telefon Numarası</label>
                            <input type="number" 
                                    id="contactPhone" 
                                    name="contactPhone" 
                                    class="w-full rounded border border-gray-300 p-2 text-sm shadow" 
                                    placeholder="Telefon Numarası" 
                                    value="<?= htmlspecialchars($contact['phone_number']) ?>" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="contactLocation" class="text-sm font-medium text-gray-500">Konum</label>
                            <input type="text" 
                                    id="contactLocation" 
                                    name="contactLocation" 
                                    class="w-full rounded border border-gray-300 p-2 text-sm shadow" 
                                    placeholder="Konum" 
                                    value="<?= htmlspecialchars($contact['location']) ?>" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="contactEmail" class="text-sm font-medium text-gray-500">Email</label>
                            <input type="email" 
                                    id="contactEmail" 
                                    name="contactEmail" 
                                    class="w-full rounded border border-gray-300 p-2 text-sm shadow" 
                                    placeholder="Email" 
                                    value="<?= htmlspecialchars($contact['email']) ?>" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2" x-data="{ contactBannerImagePreview: null, showUpload: <?= empty($contact['banner_image']) ? 'true' : 'false' ?> }" x-cloak>
                            <label for="contactBannerImage" class="text-sm font-medium text-gray-500">Ürün Banner Resim</label>
                            <div class="relative flex items-center justify-center w-full">
                                <!-- Mevcut resim gösterimi -->
                                <?php if (!empty($contact['banner_image'])): ?>
                                <div x-show="!showUpload" class="relative w-full h-64">
                                    <img src="src/panel/uploads/<?= htmlspecialchars($contact['banner_image']) ?>" class="max-h-64 rounded-lg w-full h-full object-cover" alt="Banner">
                                    <button type="button" @click="showUpload = true" class="absolute top-0 right-4 bg-red-500 text-white rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <?php endif; ?>

                                <label x-show="showUpload" for="contactBannerImage" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" x-show="!contactBannerImagePreview">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Resim yüklemek için tıklayın</span> veya sürükleyip bırakın</p>
                                        <p class="text-xs text-gray-500">PNG, JPG veya GIF (MAX. 800x400px)</p>
                                    </div>
                                    <div x-show="contactBannerImagePreview" class="absolute inset-0 flex items-center justify-center">
                                        <img :src="contactBannerImagePreview" class="max-h-full rounded-lg w-full h-full object-cover p-4" alt="Preview">
                                    </div>
                                    <input x-ref="contactBannerImageFileInput" @change="const file = $refs.contactBannerImageFileInput.files[0]; const reader = new FileReader(); reader.onload = (e) => { contactBannerImagePreview = e.target.result; }; reader.readAsDataURL(file)" id="contactBannerImage" name="contactBannerImage" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--About Content -->
                <!--Contact Social Media Content--> 
                <div x-data="{
                    socialMediaOpen: false,
                    socialMedias: [
                        <?php foreach ($social as $social): ?>
                            { name: '<?= $social['name'] ?>', url: '<?= $social['url'] ?>' },
                        <?php endforeach; ?>
                    ],
                    addSocialMedia() {
                        this.socialMedias.push({ name: '', url: '' });
                    },
                    removeSocialMedia(index) {
                        this.socialMedias.splice(index, 1);
                    }
                }" x-cloak class="flex flex-col gap-4 bg-white shadow-2xl rounded-lg p-4 my-4">
                    <div @click="socialMediaOpen = !socialMediaOpen" class="cursor-pointer flex items-center justify-between">
                        <h1 class="text-2xl font-bold">
                            Sosyal Medya Alanı
                        </h1>
                        <span class="shrink-0 transition duration-300" :class="{ '-rotate-180': socialMediaOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div x-show="socialMediaOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <div class="flex flex-col gap-4">
                            <!-- Sosyal Medya Input Alanları -->
                            <template x-for="(social, index) in socialMedias" :key="index">
                                <div class="relative flex gap-4 items-start">
                                    <div class="flex-1">
                                        <label :for="'socialName'+index" class="text-sm font-medium text-gray-500">Sosyal Medya Adı</label>
                                        <input type="text" 
                                               :id="'socialName'+index" 
                                               :name="'socialMedia['+index+'][name]'" 
                                               x-model="social.name"
                                               class="w-full rounded border border-gray-300 p-2 text-sm shadow mt-1" 
                                               placeholder="örn: Facebook, Instagram, Twitter" />
                                    </div>
                                    <div class="flex-1">
                                        <label :for="'socialUrl'+index" class="text-sm font-medium text-gray-500">Sosyal Medya URL</label>
                                        <input type="url" 
                                               :id="'socialUrl'+index" 
                                               :name="'socialMedia['+index+'][url]'" 
                                               x-model="social.url"
                                               class="w-full rounded border border-gray-300 p-2 text-sm shadow mt-1" 
                                               placeholder="https://..." />
                                    </div>
                                    <button type="button" 
                                            @click="removeSocialMedia(index)" 
                                            class="mt-7 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <button type="button" 
                                    @click="addSocialMedia()" 
                                    class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg mt-4 w-full">
                                Yeni Sosyal Medya Ekle
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
                            <input type="text" id="seoTitle" x-model="formData.seoTitle" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Seo Title" value="<?= htmlspecialchars($product['seo_title']) ?>" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="seoKeywords" class="text-sm font-medium text-gray-500">Seo Keywords</label>
                            <input type="text" id="seoKeywords" x-model="formData.seoKeywords" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Seo Keywords" value="<?= htmlspecialchars($product['seo_keywords']) ?>" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="wysiwyg" class="text-sm font-medium text-gray-500">Seo Açıklama</label>
                            <textarea id="wysiwyg" x-model="formData.seoDescription"><?= htmlspecialchars($product['seo_description']) ?></textarea>
                        </div>
                        
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="ogTitle" class="text-sm font-medium text-gray-500">Og Title</label>
                            <input type="text" id="ogTitle" x-model="formData.ogTitle" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Og Title" value="<?= htmlspecialchars($product['og_title']) ?>" />
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <label for="ogDescription" class="text-sm font-medium text-gray-500">Og Description</label>
                            <input type="text" id="ogDescription" x-model="formData.ogDescription" class="w-full rounded border border-gray-300 p-2  text-sm shadow" placeholder="Og Description" value="<?= htmlspecialchars($product['og_description']) ?>" />
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

                <div class="mt-4 flex justify-end">
                    <button type="submit" 
                        class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg disabled:bg-gray-400 disabled:hover:bg-gray-400 disabled:cursor-not-allowed">
                        Kaydet
                    </button>
                </div>
            </form>


        </section>



