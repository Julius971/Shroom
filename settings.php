<?php
    $title = "Einstellungen";
    function renderBody() {
?>

<body class="flex flex-col h-screen bg-gray-100 dark:bg-[#212226] text-gray-900 dark:text-white transition-colors duration-300">

    <header class="fixed top-0 left-0 right-0 flex items-center justify-between px-4 py-3 bg-white/50 dark:bg-black/70 backdrop-blur-lg shadow z-50 h-12">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($GLOBALS['title']) ?></h1>
        <a href="index.php" id="closePage" class="p-3 cursor-pointer">
            <img class="h-6 w-6 green-500-filter" src="https://img.icons8.com/sf-regular/100/delete-sign.png" alt="Close" />
        </a>
    </header>

    <main class="mt-16 flex-1 overflow-auto p-4 flex justify-center">
        <div class="w-full max-w-md space-y-6">
            
            <!-- Benutzername -->
            <div>
                <label for="username" class="block text-sm font-medium mb-1">Benutzername</label>
                <input
                    id="username"
                    type="text"
                    placeholder="Dein Name"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                />
            </div>

            <!-- Kartendarstellung -->
            <!-- Documentation for tile providers: https://leaflet-extras.github.io/leaflet-providers/preview/ -->
            <div class="mt-4">
                <label for="tileSourceSelect" class="block text-sm font-medium mb-1">Kartendarstellung</label>
                <div class="grid relative">
                    <select
                        id="tileSourceSelect"
                        class="col-start-1 row-start-1 appearance-none
                            bg-white dark:bg-black text-gray-900 dark:text-white
                            border border-gray-300 dark:border-gray-600
                            rounded-lg w-full p-2 pr-8
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    >
                        <option value="google">Google Maps</option>
                        <option value="osm">OpenStreetMap</option>
                        <option value="stamia">Stamen</option>
                        <option value="nasa">NASA</option>
                    </select>

                    <img
                        src="https://img.icons8.com/sf-regular/100/expand-arrow.png"
                        alt="Dropdown Arrow"
                        class="col-start-1 row-start-1 justify-self-end self-center mr-3 w-4 h-4 green-500-filter"
                    />
                </div>
            </div>

            <!-- Erscheinungsbild -->
            <div>
                <label for="themeSelect" class="block text-sm font-medium mb-1">Erscheinungsbild</label>
                <div class="grid relative">
                    <select
                        id="themeSelect"
                        class="col-start-1 row-start-1 appearance-none bg-white dark:bg-black text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-lg w-full p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    >
                        <option value="system">Systemstandard</option>
                        <option value="light">Hell</option>
                        <option value="dark">Dunkel</option>
                    </select>

                    <img
                        src="https://img.icons8.com/sf-regular/100/expand-arrow.png"
                        alt="Dropdown Arrow"
                        class="col-start-1 row-start-1 justify-self-end self-center mr-3 w-4 h-4 green-500-filter"
                    />
                </div>
            </div>

            <!-- Info section -->
            <div class="text-center text-sm space-y-2 text-gray-600 dark:text-gray-400">
                <p class="font-medium">Version 1.0.0</p>
                <p>© <?= date('Y') ?> - devsforge.de</p>
                <div class="flex justify-center space-x-4">
                    <a href="https://github.com/undeadd" target="_blank" class="hover:text-green-500 transition">
                        <img class="h-7 w-7 green-500-filter" src="https://img.icons8.com/sf-regular/100/github.png" alt="GitHub" />
                    </a>
                    <a href="https://devsforge.de/" target="_blank" class="hover:text-green-500 transition">
                        <img class="h-7 w-7 green-500-filter" src="https://img.icons8.com/sf-regular/100/geography.png" alt="Instagram" />
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>

<?php }
include 'layout.php';
