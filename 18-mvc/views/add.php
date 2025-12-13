<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pokemon</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-base-200">

    <!-- NAVBAR -->
    <div class="navbar bg-base-100 shadow-lg px-6">
        <div class="flex-1">
            <span class="text-xl font-bold">➕ Agregar Pokémon</span>
        </div>
        <div class="flex-none">
            <a href="<?= $data['url'] ?>" class="btn btn-ghost btn-sm">
                Volver
            </a>
        </div>
    </div>

    <!-- FORM -->
    <div class="container mx-auto p-6 flex justify-center">

        <div class="card bg-base-100 w-full max-w-2xl shadow-xl">
            <div class="card-body">

                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold">Nuevo Pokémon</h1>
                    <p class="text-base-content/70">
                        Registra un Pokémon en el sistema
                    </p>
                </div>

                <form method="POST" action="<?= $data['url'] ?>store" class="space-y-4">

                    <!-- BASIC INFO -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div class="form-control md:col-span-2">
                            <label class="label">
                                <span class="label-text font-semibold">
                                    Nombre del Pokémon
                                </span>
                            </label>
                            <input type="text" name="name"
                                   placeholder="Ej: Pikachu"
                                   class="input input-bordered input-lg"
                                   required autofocus />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Tipo</span>
                            </label>
                            <select name="type" class="select select-bordered select-lg" required>
                                <option disabled selected>Selecciona un tipo</option>
                                <option value="Water">💧 Water</option>
                                <option value="Grass">🌿 Grass</option>
                                <option value="Fire">🔥 Fire</option>
                                <option value="Electric">⚡ Electric</option>
                                <option value="Normal">⭐ Normal</option>
                                <option value="Poison">☠️ Poison</option>
                                <option value="Ghost">👻 Ghost</option>
                                <option value="Dragon">🐉 Dragon</option>
                                <option value="Rock">🪨 Rock</option>
                                <option value="Fighting">🥊 Fighting</option>
                                <option value="Psychic">🔮 Psychic</option>
                                <option value="Ice">❄️ Ice</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Entrenador</span>
                            </label>
                            <select name="trainer_id" class="select select-bordered select-lg">
                                <option value="">Sin entrenador</option>
                                <?php foreach($data['trainers'] as $trainer): ?>
                                    <option value="<?= $trainer['id'] ?>">
                                        <?= htmlspecialchars($trainer['name']) ?> (Lvl <?= $trainer['level'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div class="divider font-semibold">Estadísticas</div>

                    <!-- STATS -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">⚔️ Strength</span>
                            </label>
                            <input type="number" name="strength"
                                   value="100" min="1" max="1500"
                                   class="input input-bordered" required />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">❤️ Stamina</span>
                            </label>
                            <input type="number" name="staming"
                                   value="100" min="1" max="320"
                                   class="input input-bordered" required />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">⚡ Speed</span>
                            </label>
                            <input type="number" name="speed"
                                   value="50" min="1" max="120"
                                   class="input input-bordered" required />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">🎯 Accuracy</span>
                            </label>
                            <input type="number" name="accuracy"
                                   value="50" min="1" max="232"
                                   class="input input-bordered" required />
                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div class="flex flex-col md:flex-row gap-3 pt-4">

                        <button type="submit" class="btn btn-success flex-1 gap-2">
                            💾 Guardar Pokémon
                        </button>

                        <a href="<?= $data['url'] ?>" class="btn btn-outline flex-1">
                            ❌ Cancelar
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>

</body>
</html>
