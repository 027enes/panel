<main class="w-full h-screen bg-gradient-to-l to-amber-100 from-white ">
<section class="w-full h-full flex justify-center items-center flex-col">
        <div class="mb-5">
            <svg width="140" height="121" viewBox="0 0 140 121" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M140 13.713V95.5852C140 109.62 128.712 121 114.791 121H25.1972C11.2817 121 0 109.626 0 95.5976V13.7005C0 2.49488 12.6263 -3.95366 21.5888 2.67522L62.8233 33.1643C67.0979 36.3233 72.9083 36.3233 77.1829 33.1643L118.417 2.68144C127.374 -3.94122 140 2.50732 140 13.713Z" fill="#0C0C0C" fill-opacity="0.1"/>
            </svg>
        </div>
        <div class="w-1/3 p-10 bg-white rounded-lg shadow-lg">
            <form action="login.php" method="post" class="mb-0  space-y-4 rounded-lg ">
                <p class="text-center text-2xl font-bold p-4" >Giriş Yap</p>
          
                <div>
                  <label for="email" class="sr-only">Email</label>
          
                  <div class="relative">
                    <input type="email" name="email" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Enter email" />
          
                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                      </svg>
                    </span>
                  </div>
                </div>
          
                <div>
                  <label for="password" class="sr-only">Şifre</label>
          
                  <div class="relative">
                    <input type="password" name="password" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Enter password" />
          
                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                    </span>
                  </div>
                </div>
          
                <button type="submit" class="block w-full rounded-lg bg-amber-600 hover:bg-amber-500 transition-all duration-300 px-5 py-3 text-sm font-medium text-white" >
                  Giriş Yap
                </button>
          
                <p class="text-center text-sm text-gray-500">
                  Hesabın yok mu?
                  <a class="underline" href="register.php">Kayıt Ol</a>
                </p>

                <?php if(isset($status)): ?>
                  <p class="text-center text-red-500"><?= $status ?></p>
                <?php endif; ?>
                
              </form>
        </div>
    </section>
</main>