
<script src="//unpkg.com/alpinejs" defer></script>
    <script src="<?= panel_assets('js/tinymce/tinymce.min.js') ?>"></script>


    <!-- Editor script'i -->
    <script>
        tinymce.init({
          selector: '#wysiwyg, #aboutDesc, #aboutMission, #aboutVision, #productCreativeDesc, #productDesc, #categoryCreativeDesc',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
          forced_root_block: '',     // <p> etiketlerini engelle
          force_br_newlines: true,   // <br> kullan
          force_p_newlines: false,   // <p> etiketlerini zorlama
          remove_linebreaks: false,  // Satır sonlarını koru
          valid_elements: 'strong,em,span,a[href],br,p',  // İzin verilen HTML etiketleri
          invalid_elements: 'div,section,article,data-pm-slice', // İzin verilmeyen etiketler
          verify_html: true,         // HTML doğrulamasını aç
          cleanup: true,             // Temizleme özelliğini aç
          cleanup_on_startup: true,  // Başlangıçta temizle
          paste_as_text: true,       // Yapıştırılan içeriği düz metin olarak al
          setup: function(editor) {
              editor.on('BeforeSetContent', function(e) {
                  // İçerik eklenmeden önce temizle
                  e.content = e.content.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, '<br>');
                  e.content = e.content.replace(/data-pm-slice="[^"]*"/g, '');
              });
          }
        });
      </script>
</body>
</html>
