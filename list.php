<?php
    $title = "Maetzig's Pilzkarte";
    function renderBody() {
?>

<body class="flex flex-col h-screen bg-gray-100 dark:bg-[#212226] text-gray-900 dark:text-white transition-colors duration-300">

    <header class="fixed top-0 left-0 right-0 flex items-center justify-between px-4 py-3 bg-white/50 dark:bg-black/70 backdrop-blur-lg shadow z-50 h-12">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($GLOBALS['title']) ?></h1>

        <!-- Desktop button group -->
        <div class="flex space-x-2">
            <button id="toggleListType" class="flex p-3 cursor-pointer">
                <img class="h-6 w-6 green-500-filter" src="https://img.icons8.com/sf-regular/100/mushroom.png" alt="toggle shroom/findings" />
				<!-- alt image https://img.icons8.com/sf-regular/100/search.png-->
            </button>
            <a href="index.php" class="p-3 hidden md:flex justify-center items-center dark-invert cursor-pointer">
                <img class="h-6 w-6" src="https://img.icons8.com/sf-regular/100/address.png" alt="Map view" />
            </a>
            <a href="settings.php" class="p-3 hidden md:flex justify-center items-center dark-invert cursor-pointer">
                <img class="h-6 w-6" src="https://img.icons8.com/sf-regular/100/gear.png" alt="Settings" />
            </a>
            <button id="addSightingDesktop" class="hidden md:flex p-3 cursor-pointer">
                <img class="h-6 w-6 green-500-filter" src="https://img.icons8.com/sf-regular/100/plus-math.png" alt="Add Sighting" />
            </button>
        </div>
    </header>

    <main class="mt-16 flex-1 overflow-auto p-4">
        <!-- Your list content goes here -->
    </main>

    <!-- Mobile tabbar -->
    <div class="md:hidden fixed bottom-4 left-4 right-[5.5rem] bg-white/50 dark:bg-black/70 backdrop-blur-lg rounded-full shadow flex justify-around px-6 py-2 z-40">
        <a href="index.php" class="flex flex-col items-center dark:text-white cursor-pointer">
            <img class="h-6 w-6 mb-1 dark:invert" src="https://img.icons8.com/sf-regular/100/address.png" alt="Map view" />
        </a>
        <a class="flex flex-col items-center text-gray-900 dark:text-white cursor-default">
            <img class="h-6 w-6 mb-1 green-500-filter" src="https://img.icons8.com/sf-regular/100/ingredients-list.png" alt="List view" />
        </a>
        <a href="settings.php" class="flex flex-col items-center text-gray-900 dark:text-white cursor-pointer">
            <img class="h-6 w-6 mb-1 dark:invert" src="https://img.icons8.com/sf-regular/100/gear.png" alt="Settings" />
        </a>
    </div>

    <!-- Floating Add Button -->
    <button id="addSightingMobile" class="md:hidden fixed bottom-2.5 right-4 bg-green-500 text-white p-4 rounded-full shadow-lg z-50 cursor-pointer">
        <img class="h-6 w-6 no-invert" src="https://img.icons8.com/sf-regular/100/plus-math.png" alt="Add Sighting" />
    </button>

    <!-- Add Sighting Modal -->
    <div id="addSightingModal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
        <div class="bg-white dark:bg-black rounded-lg p-6 w-11/12 md:w-1/3 text-gray-900 dark:text-white">
            <h2 class="text-xl font-bold mb-4">Pilz gefunden?</h2>
            <form>
                <label class="block mb-2">
                    Pilzart:
                    <select class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-black text-gray-900 dark:text-white">
                        <option value="">Bitte wählen</option>
                        <option value="Steinpilz">Steinpilz</option>
                        <option value="Pfifferling">Pfifferling</option>
                        <option value="Fliegenpilz">Fliegenpilz</option>
                        <!-- add more species as needed -->
                    </select>
                </label>

                <label class="block mb-2">
                    Gefunden von:
                    <input type="text" placeholder="Dein Name" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-black text-gray-900 dark:text-white"/>
                </label>

                <label class="block mb-4 flex items-center justify-between">
                    Eigenschaft:
                    <div class="flex items-center space-x-2">
                        <span>Essbar</span>
                        <input type="checkbox" id="toxicitySwitch" class="toggle-checkbox hidden">
                        <label for="toxicitySwitch" class="toggle-label w-12 h-6 bg-gray-300 dark:bg-gray-700 rounded-full relative cursor-pointer">
                            <span class="dot absolute left-0 top-0 w-6 h-6 bg-white rounded-full transition"></span>
                        </label>
                        <span>Giftig</span>
                    </div>
                </label>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded">Abbrechen</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded text-white dark:text-black">Speichern</button>
                </div>
            </form>
        </div>
    </div>

</body>

<?php }
include 'layout.php';
