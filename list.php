<?php
$title = "Maetzig's Pilzkarte";
function renderBody()
{
?>

    <body class="flex flex-col h-screen bg-gray-100 dark:bg-[#212226] text-gray-900 dark:text-white transition-colors duration-300">

        <header class="fixed top-0 left-0 right-0 flex items-center justify-between px-4 py-3 bg-white/50 dark:bg-black/70 backdrop-blur-lg shadow z-50 h-12">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($GLOBALS['title']) ?></h1>

            <!-- Desktop button group -->
            <div class="flex space-x-2">
                <a href="index.php" class="p-3 hidden md:flex justify-center items-center dark-invert cursor-pointer">
                    <img class="h-6 w-6" src="assets/img/address.png" alt="Map view" />
                </a>
                <a href="settings.php" class="p-3 hidden md:flex justify-center items-center dark-invert cursor-pointer">
                    <img class="h-6 w-6" src="assets/img/gear.png" alt="Settings" />
                </a>
                <button id="addSightingDesktop" class="hidden md:flex p-3 cursor-pointer">
                    <img class="h-6 w-6 green-500-filter" src="assets/img/plus-math.png" alt="Add Sighting" />
                </button>
            </div>
        </header>

        <main class="mt-16 flex-1 overflow-auto p-4 flex justify-center">
            <div class="w-full max-w-xl space-y-6">
                <!-- Tabs -->
                <div class="flex border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden mb-4">
                    <button id="tabFindings" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 font-medium bg-green-500 text-black dark:text-white">
                        <img src="assets/img/address.png" alt="" class="w-5 h-5" />
                        Fundorte
                    </button>

                    <button id="tabTypes" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 font-medium bg-white dark:bg-black text-gray-700 dark:text-gray-300">
                        <img src="assets/img/mushroom.png" alt="" class="w-5 h-5" />
                        Pilzarten
                    </button>
                </div>

                <!-- Findings List -->
                <div id="listFindings">
                    <?php
                        $dummyFindings = [
                            ['id' => 1, 'image' => 'https://placehold.co/50x50', 'point' => '51.743, 6.863', 'distance' => 0.3, 'author' => 'Max', 'date' => '2025-10-01', 'type' => 'Steinpilz', 'data' => 'Frisch, großer Hut'],
                            ['id' => 3, 'image' => 'https://placehold.co/50x50', 'point' => '51.745, 6.865', 'distance' => 0.8, 'author' => 'Lukas', 'date' => '2025-10-03', 'type' => 'Fliegenpilz', 'data' => 'Giftig, leuchtend rot'],
                            ['id' => 2, 'image' => 'https://placehold.co/50x50', 'point' => '51.744, 6.864', 'distance' => 1.2, 'author' => 'Anna', 'date' => '2025-10-02', 'type' => 'Pfifferling', 'data' => 'Klein, viele gefunden'],
                        ];

                        foreach ($dummyFindings as $f) {
                            $dist = $f['distance'] < 1 ? ($f['distance'] * 1000) . ' m' : $f['distance'] . ' km';
                            echo '
                                <div class="p-2 mb-2 border border-gray-300 dark:border-gray-600 rounded-lg flex items-center justify-between bg-white dark:bg-black hover:bg-green-50 dark:hover:bg-green-900/30 cursor-pointer">
                                    <div class="flex items-center">
                                        <img src="' . $f['image'] . '" alt="' . $f['type'] . '" class="w-14 h-14 rounded ml-2 mr-4"/>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">' . $f['type'] . '</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Abstand: ' . $dist . '</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Von ' . $f['author'] . ' am ' . $f['date'] . ' gefunden.</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <button class="remove-sighting p-1">
                                            <img src="assets/img/trash.png" alt="Remove" class="w-6 h-6 red-500-filter"/>
                                        </button>
                                        <img src="assets/img/forward.png" alt="Chevron" class="w-5 h-5 gray-500-filter"/>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>

                <!-- Types List -->
                <div id="listTypes" class="hidden">
                    <?php
                        $dummyTypes = [
                            ['id' => 1, 'image' => 'https://placehold.co/50x50', 'name' => 'Steinpilz', 'count' => 5, 'edible' => true],
                            ['id' => 2, 'image' => 'https://placehold.co/50x50', 'name' => 'Pfifferling', 'count' => 3, 'edible' => true],
                            ['id' => 3, 'image' => 'https://placehold.co/50x50', 'name' => 'Fliegenpilz', 'count' => 0, 'edible' => false],
                        ];

                        foreach ($dummyTypes as $t) {
                            echo '
                                <div class="p-2 mb-2 border border-gray-300 dark:border-gray-600 rounded-lg flex items-center justify-between bg-white dark:bg-black">
                                    <div class="flex items-center">
                                        <img src="' . $t['image'] . '" alt="' . $t['name'] . '" class="w-14 h-14 rounded ml-2 mr-4"/>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">' . $t['name'] . '</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Gespeicherte Fundorte: ' . $t['count'] . '</div>
                                            <div class="' . ($t['edible'] ? 'text-green-500' : 'text-red-500') . ' text-sm">Pilz ist ' . ($t['edible'] ? 'essbar' : 'giftig') . '</div>
                                        </div>
                                    </div>

                                    <button class="remove-type p-1">
                                        <img src="assets/img/trash.png" alt="Remove" class="w-6 h-6 red-500-filter"/>
                                    </button>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>

            <!-- Mobile tabbar -->
            <div class="md:hidden fixed bottom-4 left-4 right-[5.5rem] bg-white/50 dark:bg-black/70 backdrop-blur-lg rounded-full shadow flex justify-around px-6 py-2 z-40">
                <a href="index.php" class="flex flex-col items-center dark:text-white cursor-pointer">
                    <img class="h-6 w-6 mb-1 dark:invert" src="assets/img/address.png" alt="Map view" />
                </a>
                <a class="flex flex-col items-center text-gray-900 dark:text-white cursor-default">
                    <img class="h-6 w-6 mb-1 green-500-filter" src="assets/img/ingredients-list.png" alt="List view" />
                </a>
                <a href="settings.php" class="flex flex-col items-center text-gray-900 dark:text-white cursor-pointer">
                    <img class="h-6 w-6 mb-1 dark:invert" src="assets/img/gear.png" alt="Settings" />
                </a>
            </div>

            <!-- Floating Add Button -->
            <button id="addSightingMobile" class="md:hidden fixed bottom-2.5 right-4 bg-green-500 text-white p-4 rounded-full shadow-lg z-50 cursor-pointer">
                <img class="h-6 w-6 no-invert" src="assets/img/plus-math.png" alt="Add Sighting" />
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
                            <input type="text" placeholder="Dein Name" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-black text-gray-900 dark:text-white" />
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
include 'assets/php/layout.php';
