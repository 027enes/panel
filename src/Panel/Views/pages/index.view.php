<?php
/*$items = Data::get_products();
$totalItems = count($items);
*/
?>
        

        <!--Dashboard-->
        <section class="w-full h-full p-20">
            <!-- Header -->
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold">
                    Dashboard
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
                            <a href="#" class="block transition hover:text-gray-700"> Dashboard </a>
                          </li>

                        </ol>
                      </nav>
                </div>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="h-14 w-14 rounded-full bg-gray-100 grid place-content-center font-bold text-xl">
                                    EI
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-gray-500">
                                        Admin
                                    </span>
                                    <span class="text-sm font-bold">
                                        Enes İnan
                                    </span>
                                </div>         
                            </div>
                            <div class="flex flex-col">
                                <a href="exit.php" class="text-sm bg-gray-100 px-4 py-2 rounded-lg text-gray-900 font-bold flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                        <path d="M15 17.625C14.9264 19.4769 13.3831 21.0494 11.3156 20.9988C10.8346 20.987 10.2401 20.8194 9.05112 20.484C6.18961 19.6768 3.70555 18.3203 3.10956 15.2815C3 14.723 3 14.0944 3 12.8373L3 11.1627C3 9.90561 3 9.27705 3.10956 8.71846C3.70555 5.67965 6.18961 4.32316 9.05112 3.51603C10.2401 3.18064 10.8346 3.01295 11.3156 3.00119C13.3831 2.95061 14.9264 4.52307 15 6.37501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M21 12H10M21 12C21 11.2998 19.0057 9.99153 18.5 9.5M21 12C21 12.7002 19.0057 14.0085 18.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Çıkış Yap
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 flex items-center justify-between rounded-lg shadow-lg">
                        <figure class="">
                            <svg width="auto" height="20" viewBox="0 0 150 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M88.0076 7.12971C86.7361 4.84766 84.9307 3.0905 82.5928 1.8537C80.2535 0.616893 77.5431 0 74.4616 0C71.3817 0 68.6728 0.616893 66.3349 1.8537C63.9971 3.0905 62.1886 4.84766 60.9156 7.12971C59.6396 9.41177 59.0061 12.0332 59.0061 15.0015C59.0061 17.9668 59.6411 20.5913 60.9156 22.8703C62.1871 25.1523 63.9955 26.9125 66.3349 28.1463C68.6728 29.3831 71.3802 30 74.4616 30C77.5416 30 80.2535 29.3831 82.5913 28.1463C84.9292 26.9125 86.7346 25.1629 88.0061 22.902C89.2821 20.6365 89.9186 18.006 89.9186 15.0015C89.9201 12.0332 89.2821 9.41177 88.0076 7.12971Z" fill="#150D2B"/>
                                <path d="M46.5686 0.0949707H47.2081C50.6048 0.0949707 53.3589 2.84912 53.3589 6.2458V23.7556C53.3589 27.1523 50.6048 29.9064 47.2081 29.9064H46.5686C43.1719 29.9064 40.4177 27.1523 40.4177 23.7556V6.2458C40.4177 2.84761 43.1719 0.0949707 46.5686 0.0949707Z" fill="#150D2B"/>
                                <path d="M104.383 27.0965L94.4482 6.99995C92.8765 3.82046 95.1902 0.0949707 98.7378 0.0949707H119.151C122.699 0.0949707 125.012 3.82046 123.441 6.99995L113.505 27.0965C111.637 30.8732 106.251 30.8732 104.383 27.0965Z" fill="#150D2B"/>
                                <path d="M139.869 2.63044L149.649 25.3469C150.576 27.5037 148.996 29.9049 146.649 29.9049H125.382C123.035 29.9049 121.453 27.5022 122.382 25.3469L132.161 2.63044C133.617 -0.751161 138.412 -0.751161 139.869 2.63044Z" fill="#150D2B"/>
                                <path d="M34.2338 3.88384V23.7421C34.2338 27.1463 31.4736 29.9065 28.0694 29.9065H6.16139C2.75867 29.9065 0 27.1478 0 23.7451V3.88083C0 1.16288 3.08748 -0.401226 5.27904 1.20662L15.362 8.60179C16.4072 9.368 17.8281 9.368 18.8733 8.60179L28.9563 1.20813C31.1463 -0.398209 34.2338 1.16589 34.2338 3.88384Z" fill="#150D2B"/>
                            </svg>
                        </figure>
                        <ul class="flex gap-1">
                            <li>
                                <a href="https://github.com/027enes" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                        <path d="M10 20.5675C6.57143 21.7248 3.71429 20.5675 2 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 22V18.7579C10 18.1596 10.1839 17.6396 10.4804 17.1699C10.6838 16.8476 10.5445 16.3904 10.1771 16.2894C7.13394 15.4528 5 14.1077 5 9.64606C5 8.48611 5.38005 7.39556 6.04811 6.4464C6.21437 6.21018 6.29749 6.09208 6.31748 5.9851C6.33746 5.87813 6.30272 5.73852 6.23322 5.45932C5.95038 4.32292 5.96871 3.11619 6.39322 2.02823C6.39322 2.02823 7.27042 1.74242 9.26698 2.98969C9.72282 3.27447 9.95075 3.41686 10.1515 3.44871C10.3522 3.48056 10.6206 3.41384 11.1573 3.28041C11.8913 3.09795 12.6476 3 13.5 3C14.3524 3 15.1087 3.09795 15.8427 3.28041C16.3794 3.41384 16.6478 3.48056 16.8485 3.44871C17.0493 3.41686 17.2772 3.27447 17.733 2.98969C19.7296 1.74242 20.6068 2.02823 20.6068 2.02823C21.0313 3.11619 21.0496 4.32292 20.7668 5.45932C20.6973 5.73852 20.6625 5.87813 20.6825 5.9851C20.7025 6.09207 20.7856 6.21019 20.9519 6.4464C21.6199 7.39556 22 8.48611 22 9.64606C22 14.1077 19.8661 15.4528 16.8229 16.2894C16.4555 16.3904 16.3162 16.8476 16.5196 17.1699C16.8161 17.6396 17 18.1596 17 18.7579V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
